<?php

namespace App\Http\Controllers;

use App\Statement;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Statements\Generator;

class StatementsController extends Controller
{
    /**
     * show a view of all compiled reports
     *
     * @param      \Illuminate\Http\Request  $request  
     *
     * @return     Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $statements=Statement::latest("year")->latest("month")->simplePaginate(12);
            return response()->json($statements);
        }

        return view("statements.index");
    }

    /**
     * generate and persists a pdf to the storage
     *
     * @param      \Illuminate\Http\Request  $request  
     *
     * @return     Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ["date"=>"required"]);

        $statement=Statement::locate($request->date);

        if ($statement->alreadyExists()) {
            return response()->view("statements.existing", compact("statement"));
        }
        if ($statement->generate()) {
            $status="Statement Generated Successfully";
            return response()->view("statements.show", compact("statement","status"));
        }

        return response()->view("statements.empty", compact("statement"));
    }
    /**
     * show a statement
     *
     * @param      \App\Statement  $statement  
     *
     * @return     \Illuminate\Http\Response
     */
    public function show(Statement $statement)
    {
        return $statement->stream();
    }

    public function update(Statement $statement)
    {
        if ($statement->recompile()) {
            $status="Statement Recompiled successfully";
            return response()->view("statements.show", compact("statement","status"));
        }

        return response()->view("statements.empty", compact("statement"));
    }

    public function destroy(Statement $statement)
    {
        $deletedStatement=$statement;
        $statement->delete();
        return response()->view("statements.deleted",[
            "statement"=>$deletedStatement
            ]);
    }
}
