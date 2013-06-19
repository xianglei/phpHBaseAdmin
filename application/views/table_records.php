<link href="<?php echo $this->config->base_url();?>css/kendo.common.min.css" rel="stylesheet">
<link href="<?php echo $this->config->base_url();?>css/kendo.default.min.css" rel="stylesheet">

<script src="<?php echo $this->config->base_url();?>js/kendo.web.min.js"></script>
<script>

function showmeta()
{
    $('#metadata').modal({
         backdrop:true
      })
    $("#tab").empty();
    $("#myTabContent").empty();  
    $.getJSON('<?php echo $this->config->base_url();?>index.php/tables/getdescriptors/<?php echo $tablename?>', function(json){
         var content="";
         var i=1;
         var ultab='';
         $.each(json,function(key,value){
             key=key.replace(":","");
             if(i==1)
             {
                ultab=ultab+'<li class="active"><a href="#'+key+'" data-toggle="tab">'+key+'</a></li>';
                content=content+'<div class="tab-pane fade in active" id="'+key+'">';
             }
             else
             {
                ultab=ultab+'<li><a href="#'+key+'" data-toggle="tab">'+key+'</a></li>';
                content=content+'<div class="tab-pane fade" id="'+key+'">';
             }             
             content=content+'<table class="table table-bordered table-striped  table-hover" id="metadata">';             
             content=content+"<tr><td>maxVersions</td><td>"+value["maxVersions"]+"</td><tr>";
             content=content+"<tr><td>compression</td><td>"+value["compression"]+"</td><tr>";
             content=content+"<tr><td>inMemory</td><td>"+value["inMemory"]+"</td><tr>";
             content=content+"<tr><td>bloomFilterType</td><td>"+value["bloomFilterType"]+"</td><tr>";
             content=content+"<tr><td>bloomFilterVectorSize</td><td>"+value["bloomFilterVectorSize"]+"</td><tr>";
             content=content+"<tr><td>bloomFilterNbHashes</td><td>"+value["bloomFilterNbHashes"]+"</td><tr>";
             content=content+"<tr><td>blockCacheEnabled</td><td>"+value["blockCacheEnabled"]+"</td><tr>";
             content=content+"<tr><td>timeToLive</td><td>"+value["timeToLive"]+"</td><tr>";
             content=content+"</table></div>";
             i=i+1;             
         });
          $("#tab").append(ultab); 
          $("#myTabContent").append(content);                
     });
    
      
}
function trundialog()
{
   $('#truntable').attr('disabled',false);
   $('#trun').modal({
         backdrop:true
      }) 
}
function showsearch(){
   $('#searchtab').modal({
      backdrop:true
        });
   $(':input').val("");
    $('#searchtable').val("search");
       
}  
function truntable()
{
   var url='<?php echo $this->config->base_url();?>index.php/tables/truncatetable/<?php echo $tablename?>'; 
   $('#truntable').text("loading");
   $('#truntable').attr('disabled',true);
   $('#truntable').load(url,function(response,status){
       if (status=="success")
       {
          $('#truntable').text("Truncate");
          $('#truntable').attr('disabled',false);          
          alert('truncate table success');
          closemodal("trun");
          location.reload();
       }    
    
   }) 
}
function deldialog()
{
   $('#deltable').attr('disabled',false);
   $('#deltab').modal({
         backdrop:true
      })  
}
function deltable()
{
  var url='<?php echo $this->config->base_url();?>index.php/tables/deltable/<?php echo $tablename?>';
  $('#deltable').text("loading");
  $('#deltable').attr('disabled',true);
  $('#truntable').load(url,function(response,status){
       if (status=="success")
       {
          $('#deltable').text("Delete");
          $('#truntable').attr('disabled',false);          
          alert('delete table success');
          closemodal("deltab");
          window.location= ('<?php echo $this->config->base_url();?>index.php'); 
       }    
    
   }) 
     
}
function closemodal(divid)
{
    $('#'+divid).modal('hide');
}

</script>
<div class="row-fluid">
    <div class="span9" style="margin-left: 110px;">
        <h2><?php echo $tablename?></h2>
    </div>
    
    <div class="span9" style="margin-left: 110px;margin-bottom: 20px;">
       <div class="btn-group">
          <a class="btn btn-primary" href="javascript:;" onclick="showmeta();"><i class="icon-check icon-white"></i> show metadata</a>         
       </div> 
       <div class="btn-group">
          <a class="btn btn-primary" href="javascript:;" onclick="showsearch();"><i class="icon-search icon-white"></i> search records</a>         
       </div>   
       <div class="btn-group">
          <a class="btn btn-danger" href="javascript:;" onclick="trundialog();"><i class="icon-ban-circle icon-white"></i> truncate table</a>            
       </div>
        <div class="btn-group">
          <a class="btn btn-danger" href="javascript:;" onclick="deldialog();"><i class="icon-remove icon-white"></i> delete table</a>            
       </div>
        
    </div>
    
    <div class="modal hide" id="metadata">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3><?php echo $tablename?> table metadata</h3>
      </div>
      <div class="modal-body">
         <ul id="tab" class="nav nav-tabs">
         </ul>  
         <div id="myTabContent" class="tab-content">
             
         </div>    
      </div> 
    </div>
    
    <div class="modal hide" id="trun">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>truncate table <?php echo $tablename?> </h3>
      </div>
      <div class="modal-body">
        <p>Are you sure truncate table <?php echo $tablename?>? </p>
      </div>
      <div class="modal-footer"> 
        <button type="button" id="truntable" class="btn btn-danger" onclick="truntable();">Truncate</button>
        <a href="javascript:;" class="btn" onclick="closemodal('trun');">Cancel</a>
      </div>
    </div>
    
    <div class="modal hide" id="deltab">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>delete table <?php echo $tablename?> </h3>
      </div>
      <div class="modal-body">
        <p>Are you sure delete table <?php echo $tablename?>? </p>
      </div>
      <div class="modal-footer"> 
        <button type="button" id="deltable" class="btn btn-danger" onclick="deltable();">Delete</button>
        <a href="javascript:;" class="btn" onclick="closemodal('deltab');">Cancel</a>
      </div>
    </div>
    
    <div class="modal hide" id="searchtab">
      <form class="form-horizontal" id="searchform" method="POST" action="<?php echo $this->config->base_url();?>index.php/tables/searchtable/<?php echo $tablename?>">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>search table <?php echo $tablename?> </h3>
      </div>
      <div class="modal-body">
         
         <!-- Search input-->
            <div class="control-group">
              <label class="control-label span2" for="searchinput">start key</label>
              <div class="controls span8">
                <input id="startrow" name="startrow" type="text" placeholder="" class="input-medium search-query">                 
                 <select id="scomoption" name="scomoption" class="input-mini">
                  <option><</option>
                  <option><=</option>
                  <option>=</option>
                  <option>!=</option>
                  <option>></option>
                  <option>>=</option>
                 </select>
                 
                 <select id="srowoption" name="srowoption" class="input-small">
                  <option>binary</option>
                  <option>binaryprefix</option>
                  <option>regexstring</option>
                  <option>substring</option>
                 </select>
              </div>
            </div>
            
            <!-- Search input-->
            <div class="control-group">
              <label class="control-label span2" for="searchinput">stop key</label>
              <div class="controls span8">
                <input id="stoprow" name="stoprow" type="text" placeholder="" class="input-medium search-query">
                    <select id="ecomoption" name="ecomoption" class="input-mini">
                      <option><</option>
                      <option><=</option>
                      <option>=</option>
                      <option>!=</option>
                      <option>></option>
                      <option>>=</option>
                     </select>
                  
                  <select id="erowoption" name="erowoption" class="input-small">
                  <option>binary</option>
                  <option>binaryprefix</option>
                  <option>regexstring</option>
                  <option>substring</option>
                 </select>
              </div>
            </div>
            
            
            <!-- Search input-->
            <div class="control-group">
              <label class="control-label span2" for="searchinput">timestamp</label>
              <div class="controls span8">
                <input id="starttime" name="starttime" type="text" placeholder="" class="input-medium search-query"> 
                 </label>               
              </div>
             
            </div> 
            
            <!-- Search input-->
            <div class="control-group">
              <label class="control-label span2" for="searchinput">value</label>
              <div class="controls span8">
              
                <input id="wordvalue" name="wordvalue" type="text" placeholder="" class="input-medium search-query" />
                 <select id="vcomoption" name="vcomoption" class="input-mini">
                      <option><</option>
                      <option><=</option>
                      <option>=</option>
                      <option>!=</option>
                      <option>></option>
                      <option>>=</option>
                     </select>
                  
                  <select id="valueoption" name="valueoption" class="input-small">
                  <option>binary</option>
                  <option>binaryprefix</option>
                  <option>regexstring</option>
                  <option>substring</option>
                 </select>
              </div>
            </div>
            
      </div>
      <div class="modal-footer"> 
        <input type="submit" id="searchtable" class="btn btn-primary" value="search">
        <a href="javascript:;" class="btn" data-dismiss="modal">Cancel</a>
      </div>
      </form>
    </div>
    
    <div class="span9" style="margin-left: 110px;">
      <div id="grid"></div>       
    </div>
</div>


<script>


        
  $(document).ready(function () {
                    var crudServiceBaseUrl = "<?php echo $this->config->base_url();?>index.php/tables",
                         
                        dataSource = new kendo.data.DataSource({                            
                            transport: {                            
                                read:  {
                                    url: crudServiceBaseUrl+"/gettablerecords/<?php echo $tablename?>",
                                    dataType: "json"
                                },                                
                                update: {
                                    url: crudServiceBaseUrl + "/updaterecords/<?php echo $tablename?>",
                                    dataType: "json",
                                    data:"GET"                                   
                                },
                                destroy: {
                                    url: crudServiceBaseUrl + "/destroyrecords/<?php echo $tablename?>",
                                    dataType: "json",
                                    data:"GET" 
                                },
                                create: {
                                    url: crudServiceBaseUrl + "/updaterecords/<?php echo $tablename?>",
                                    dataType: "json",
                                    data:"GET"
                                },
                                parameterMap: function(options, operation) {                                    
                                    if (operation !== "read" && options.models) {
                                        return {models: kendo.stringify(options.models)};
                                    }
                                }
                            },                                              
                            batch: true,
                           
                            pageSize: 10,                                                                                                            
                            schema: {
                               
                                model: {
                                    id: "row",
                                    fields: { 
                                        row: { editable: true, nullable: true,validation: { required: true} },                                        
                                        columnfamily: { defaultValue: "<?php echo $column?>" },
                                        columnqualifier: { type: "string", validation: { required: true} },
                                        timestamp: {type: "number",validation: { min: 0, required: true },defaultValue: <?php echo time();?>},
                                        value: { type: "string", validation: { required: true } }
                                            }
                                      }                                      
                                   },
                            requestEnd: onRequestEnd
                        });
                      
                    $("#grid").kendoGrid({
                        dataSource: dataSource,
                        navigatable: true,
                        sortable: true,                                             
                        filterable:true,
                        resizable: true,                                                
                        pageable:true,                        
                        columnMenu: true,                                       
                        toolbar: ["create"],
                        columns: [
                            { field: "row", title: "row key"},
                            { field: "columnfamily",title: "column family",editor: categoryDropDownEditor, template: "#=columnfamily#" },
                            { field: "columnqualifier", title: "column qualifier" },
                            { field: "timestamp", title: "timestamp",format: "{0:0}"},
                            { field: "value",title:"value"},
                            { command: ["edit","destroy"], title: "&nbsp;"}],                            
                        editable: "inline"
                    });
                     
                    function categoryDropDownEditor(container, options) {
                    $('<input data-text-field="columnfamily" data-value-field="row" data-bind="value:' + options.field + '"/>')
                        .appendTo(container)                        
                        .kendoDropDownList({
                            autoBind: false,                           
                            dataSource: {                               
                                transport: {
                                    read:{
                                       dataType: "json",
                                       url: crudServiceBaseUrl+"/getcolumnjson/<?php echo $tablename?>" 
                                    }
                                    
                                }
                            }
                            
                        });
                        
                };                
                
                     function onRequestEnd(e) { 
                           if(e.type=="update" || e.type=="create")
                             {                                
                                 alert(e.response[0].result);
                                 location.reload();
                                                                 
                             }  
                       };
               
 });
                
                
</script>

