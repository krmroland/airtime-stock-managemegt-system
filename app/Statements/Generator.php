<?php

namespace App\Statements;

use App\Fielder;
use App\Statement;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Storage;

class Generator
{
    /**
     * the statement being generated
     *
     * @var \App\Statement
     */
    protected $statement;

    /**
     * creates and instnce of the generator class
     *
     * @param      \Illuminate\Http\Request  $request
     */
    public function __construct(Statement $statement)
    {
        $this->statement=$statement;
    }

    /**
     * Sets the base query.
     *
     * @return     self
     */
    public function fetchData()
    {
        return $this->buildQuery()->get();
    }

    /**
     * builds a query.
     *
     * @return     Illuminate\Database\Eloquent\Builder
     */
    public function buildQuery()
    {
        return Fielder::whereHas("transactions", function ($query) {
            return $query->whereHas("originalTransaction", function ($query) {
                return $query->whereMonth("date", $this->statement->getMonth())
                                ->whereYear("date", $this->statement->year)
                                ->oldest("date");
            });
        })->with(["transactions.originalTransaction.transactable"]);
    }
    /**
     * Stores a pdf.
     *
     * @return     boolean
     */
    public function storePdf()
    {
        $data=$this->fetchData();

    
        if ($data->isEmpty()) {
            return false;
        }

        $pdf=$this->egine()->loadView("statements.monthly", [
            "fielders"=>$data,
            "statement"=>$this->statement
            ]);

        $this->savePdf($pdf->output());

        return true;
    }
    /**
     * saves the pdf to the storage location
     *
     * @param      string  $pdf    
     *
     * @return     self  
     */
    public function savePdf($pdf)
    {
        Storage::put($this->storagePath(), $pdf, "public");

        return $this;
    }
    /**
     * open the pdf in the browser
     *
     * @return     Illuminate\Http\Response
     */
    public function stream()
    {
       return  response(Storage::get($this->storagePath()), 200, [
               'Content-Description' => 'File Transfer',
               'Content-Disposition' => 'inline; filename="'.$this->statement->path()->getName().'"',
               'Content-Transfer-Encoding' => 'binary',
               'Content-Type' => 'application/pdf',
               ]);
    }
    /**
     * get the storage path
     *
     * @return     string 
     */
    protected function storagePath()
    {
       return  $this->statement->path()->storage();
    }

    public function delete()
    {
        return Storage::delete($this->storagePath());
    }
    /**
     * egine used for compiling pfds
     *
     * @return     \Barryvdh\DomPDF\PDF
     */
    public function egine()
    {
        return app(PDF::class);
    }
}
