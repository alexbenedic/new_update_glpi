<style>
.content {
    max-width: 500px;
    margin: auto;
     height: 100%;
}
    .container {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto
}

@media (min-width:768px) {
    .container {
        width: 750px
    }
}

@media (min-width:992px) {
    .container {
        width: 970px
    }
}

@media (min-width:1200px) {
    .container {
        width: 1170px
    }
}

.container-fluid {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto
}
    
.form-horizontal .checkbox,
.form-horizontal .checkbox-inline,
.form-horizontal .radio,
.form-horizontal .radio-inline {
    padding-top: 7px;
    margin-top: 0;
    margin-bottom: 0
}

.form-horizontal .checkbox,
.form-horizontal .radio {
    min-height: 27px
}

.form-horizontal .form-group {
    margin-right: -15px;
    margin-left: -15px
}

@media (min-width:768px) {
    .form-horizontal .control-label {
        padding-top: 7px;
        margin-bottom: 0;
        text-align: right
    }
}

.form-horizontal .has-feedback .form-control-feedback {
    right: 15px
}

@media (min-width:768px) {
    .form-horizontal .form-group-lg .control-label {
        padding-top: 11px;
        font-size: 18px
    }
}

@media (min-width:768px) {
    .form-horizontal .form-group-sm .control-label {
        padding-top: 6px;
        font-size: 12px
    }
}
  .col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,.col-xs-1,.col-xs-10,.col-xs-11,.col-xs-12,.col-xs-2,.col-xs-3,.col-xs-4,.col-xs-5,.col-xs-6,.col-xs-7,.col-xs-8,.col-xs-9{position:relative;min-height:1px;padding-right:15px;padding-left:15px}
    .form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s
}
.btn-warning {
    color: #fff;
    background-color: #f0ad4e;
    border-color: #eea236
}

.btn-warning.focus,
.btn-warning:focus {
    color: #fff;
    background-color: #ec971f;
    border-color: #985f0d
}

.btn-warning:hover {
    color: #fff;
    background-color: #ec971f;
    border-color: #d58512
}

.btn-warning.active,
.btn-warning:active,
.open > .dropdown-toggle.btn-warning {
    color: #fff;
    background-color: #ec971f;
    border-color: #d58512
}

.btn-warning.active.focus,
.btn-warning.active:focus,
.btn-warning.active:hover,
.btn-warning:active.focus,
.btn-warning:active:focus,
.btn-warning:active:hover,
.open > .dropdown-toggle.btn-warning.focus,
.open > .dropdown-toggle.btn-warning:focus,
.open > .dropdown-toggle.btn-warning:hover {
    color: #fff;
    background-color: #d58512;
    border-color: #985f0d
}

.btn-warning.active,
.btn-warning:active,
.open > .dropdown-toggle.btn-warning {
    background-image: none
}

.btn-warning.disabled.focus,
.btn-warning.disabled:focus,
.btn-warning.disabled:hover,
.btn-warning[disabled].focus,
.btn-warning[disabled]:focus,
.btn-warning[disabled]:hover,
fieldset[disabled] .btn-warning.focus,
fieldset[disabled] .btn-warning:focus,
fieldset[disabled] .btn-warning:hover {
    background-color: #f0ad4e;
    border-color: #eea236
}

.btn-warning .badge {
    color: #f0ad4e;
    background-color: #fff
}

    .form-inline .control-label {
        margin-bottom: 0;
        vertical-align: middle
    }
</style>
<!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<body>

<div class=" container content">
  <h2>Manual upload form</h2>
<!--
  <form class="form-horizontal"  method="GET" name="upload_excel" enctype="multipart/form-data">
    <div class="form-group">
      <label class="control-label" style="width:16.66666667% ;" for="email"><b>Asset Type:</b></label>
        <br>
      <div  style="width:41.66666667%;">
<select class="form-control" name="asset" >
<option selected disabled >Select Asset</option>
<option value="Computer">Computer</option>
<option value="Server">Server</option>
<option value="Printer">Printer</option>
<option value="Others">Others</option>
</select>
      </div>
    </div>
      <br>
   <div class="form-group">
     
            
          <div class="col-md-4">
                                <input type="file" name="file"
                        id="file" accept=".csv">
                            </div>
         </div>
      <br>
    <div class="form-group">
      <label class="control-label" style="width:16.66666667% ;" for="email"><b>Option Type:</b></label>
      <div style="width:41.66666667%;">
<select class="form-control" name="option">
<option selected disabled>Select Option</option>
<option value="Add">Add</option>
<option value="Update">Update</option>

</select>
      </div>
    </div>
      <br>
    <div class="form-group">        
      <div class="col-sm-offset-2 " style="width:83.33333333%">
        <button type="submit" name="manual_form" class="btn btn-warning">Submit</button>
      </div>
    </div>
  </form>
-->
      <form class="form-horizontal" action="bulk_functions.php" method="POST" name="upload_excel" enctype="multipart/form-data">
 <div class="form-group">
      <label class="control-label" style="width:16.66666667% ;" for="email"><b>Asset Type:</b></label>
        <br>
      <div  style="width:41.66666667%;">
<select class="form-control" name="asset" >
<option selected disabled >Select Asset</option>
<option value="Computer">Computer</option>
<option value="Server">Server</option>
<option value="Printer">Printer</option>
<option value="Others">Others</option>
</select>
      </div>
    </div>
      <br>
    <div class="form-group">
      <label class="control-label col-sm-2" for="file">Select File:</label>
            
          <div class="col-md-4">
                                <input type="file" name="file" id="file" class="input-large">
                            </div>
         </div>
          <br>
       <div class="form-group">
      <label class="control-label" style="width:16.66666667% ;" for="email"><b>Option Type:</b></label>
      <div style="width:41.66666667%;">
<select class="form-control" name="option" onchange="myFunction()" id="opt" >
<option selected disabled>Select Option</option>
<option value="Add">New Record</option>
<option value="Update">Update Record</option>

</select>
          
      </div>
    </div>
          

      <br>
<div class="form-group">
                          
                            <div class="col-md-4">
                                <button type="submit" id="submit" name="Import" class="btn btn-warning" data-loading-text="Loading...">Import</button>
                            </div>
                        </div>
  </form>
</div>


</body>
