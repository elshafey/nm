<ul>
    <li>
        <a href="<?php echo site_url('admin/user/create') ?>"><?php echo lang('users_form_create_page_title') ?></a>
    </li>
    <li>
        <table id="list2"></table>
        <div id="pager2"></div>
    </li>
</ul>

<script>var mydata =<?php echo json_encode($responce) ?>;
    jQuery("#list2").jqGrid(
    { 
        direction:"<?php echo get_dir() ?>",
        datatype: "local",
        colNames:["<?php echo lang("{$controller}_name") ?>","<?php echo lang("{$controller}_username") ?>","Is active?","","",],
        colModel:[
            {name:"name",index:"name",width:180},
            {name:"username",index:"username",width:180},
            {name:"is_active",index:"is_active",width:80,classes:'grid_center'},
            {name:"edit",index:"edit",width:80},
            {name:"delete",index:"delete",width:80}
        ],
        rowNum:10,
        rowList:[10,20,30],
        height:230,
        width:910,
        pager: '#pager2',
        sortname: 'page_order',
        viewrecords: true,
        sortorder: 'desc',
        data: mydata,
        loadonce: true
    });
    jQuery('#list2').jqGrid('navGrid','#pager2',{edit:false,add:false,del:false,search:false});
</script>
