<nav class="navbar navbar-toggleable-md navbar-inverse bg-primary">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">Lawma</a>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="{{ route('home') }}"> <i class="fa fa-home"></i> Home </a>
      <a class="nav-item nav-link" href="{{ route('stock.index') }}">Stock</a>
      <a class="nav-item nav-link" href="/fielders">
        <i class="fa fa-users"></i>
        Dsrs
      </a>
      <a class="nav-item nav-link" href="{{ route('payments.index') }}">
        <i class="fa fa-money"></i>
        Payments
      </a>
      <a class="nav-item nav-link" href="{{ route('transactions.index') }}">
        <i class="fa fa-money"></i>
        Transactions
      </a>
      <a class="nav-item nav-link" href="{{ route('reports.index') }}">
        <i class="fa fa-bar-chart"></i>
       Reports
      </a>
      <a class="nav-item nav-link" href="{{ route('configurations.index') }}">
        Configurations
      </a>
      <a class="nav-item nav-link" href="{{ route('serials.index') }}">
        Serial Numbers
      </a>
      <a class="nav-item nav-link" href="{{ route('statements.index') }}">
        Satements
      </a>
      <a class="nav-item nav-link" href="{{ route('docs') }}">
        Docs
      </a>
      <a class="nav-item nav-link" href="/logout">

       Logout
      </a>
    </div>
  </div>
</nav>
