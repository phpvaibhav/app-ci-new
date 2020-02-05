var school_list = $('#school_list').DataTable({ 
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' servermside processing mode.
                "order": [], //Initial no order.
                "lengthChange": false,
                "oLanguage": {
                  "sEmptyTable" : '<center>No Record found</center>',
                 // "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>' 
                },
                "oLanguage": {
                  "sZeroRecords" : '<center>No Record found</center>',
                //  "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>' 
                },
                initComplete: function () {
                  $('.dataTables_filter input[type="search"]').css({ 'height': '32px'});
                },
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": base_url+"adminapi/school/schoolList",
                    "type": "POST",
                    "dataType": "json",
                    "headers": { 'authToken':authToken},
                    "dataSrc": function (jsonData) {
                      return jsonData.data;
                    }
                },
                //Set column definition initialisation properties.
                "columnDefs": [
                  { orderable: false, targets: -1 },    
                ]
              });