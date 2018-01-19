@component("documents.layout")
@slot("mainHeader") Getting Started @endslot
@slot("subHeader")
An overview of the airtime management system, including how to use it, cool featurs
and more.
@endslot

<h2 class="is-2">Introduction</h2>
<div class="body-title">
   Airtime Management system is a customized Online/Offline system for maintaining tracking and organizing Airtime Direct Sales representatives,Stock Sales, Payments,
   Finacial Statements and other vital components of the airtime system 
   that might be hand to track manually making managing airtime business easier than ever
   <br>

 <strong class="text-info">  
    Its built using Laravel, A modern Php Framework, Vue.js, Modern Javascript Reactive framework , an the worlds best databae Relational Database Management System (Mysql).
</strong>
</div>
<h2 class="is-2">Contents</h2>
<ul>
    <li>
       <span class="is-3">  Direct Sales Representatives (DRS)</span>
       <ul>
         <li><a href="">Registering a Dsr</a></li>
         <li> <a href="">Editing A  Dsr's Profile</a></li>
         <li><a href="">Uploading A dsr's Photo</a></li>
         <li><a href="">Dsr's Transaction History</a></li>
     </ul>
 </li>
 <li>
    <span class="is-3">Stock</span>
    <ul>
        <li><a href="">purchasing Stock With Serial Numbers</a></li>
        <li><a href="">purchasing Stock Without Serial Numbers</a></li>
        <li><a href="">Issuing Stock With Serial Numbers</a></li>
        <li><a href="">Issuing Stock Without Serial Numbers</a> </li>
        <li><a href="">Monitoring The stock Available in the store</a> </li>
        <li><a href="">The Stock Transaction Logs</a></li>
    </ul>
</li>
<li>
    <span class="is-3">Transactions Logs</span>
    <ul>
        <li><a href="">Payments</a></li>
        <li><a href="">Stock Purchases</a></li>
        <li><a href="">Stock Loadings</a></li>
       
    </ul>
</li>

<li>
    <span class="is-3">Payments</span>
    <ul>
        <li> <a href="">Receiving Payments</a></li>
        <li><a href="">Finding Payment details</a></li>
    </ul>

</li>


</ul>
@endcomponent

