<?php

function load_editor($element, $value = '') {
    /* @var $CI My_Controller */
    $CI = get_instance();
    $CI->ckeditor->basePath = base_url() . 'application/third_party/ckeditor/';
    $CI->ckeditor->ToolbarSet = 'Advanced';
    $CI->ckeditor->returnOutput = true;
    $ckeconfig = array(
        'width' => "700px",
        'height' => '400px',
        'filebrowserBrowseUrl' => base_url() . 'ckfinder/ckfinder.html',
        'filebrowserImageBrowseUrl' => base_url() . 'ckfinder/ckfinder.html?type=Images',
        'filebrowserFlashBrowseUrl' => base_url() . 'ckfinder/ckfinder.html?type=Flash',
        'filebrowserUploadUrl' => base_url() . 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        'filebrowserImageUploadUrl' => base_url() . 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        'filebrowserFlashUploadUrl' => base_url() . 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    );

    return $CI->ckeditor->editor($element, $value, $ckeconfig);
}

function file_finder_txt($path){
    return '
        <script type="text/javascript">

        function '.$path.'BrowseServer()
        {
            var finder = new CKFinder();
            finder.basePath = site_url(\'ckfinder\');	// The path for the installation of CKFinder (default = "/ckfinder/").
            finder.selectActionFunction = '.$path.'SetFileField;
            finder.popup();
        }

        // This is a sample function which is called when a file is selected in CKFinder.
        function '.$path.'SetFileField( fileUrl )
        {
            var p=fileUrl;
            arr=p.split("uploads");
            document.getElementById( "'.$path.'" ).value = ("uploads"+arr[1]);
                        
            var thumb_path=get_thumb_path(fileUrl);
            
            $("#'.$path.'").parent().find("#img_thumb").css("background-image", "url(\'"+thumb_path+"\')");
            $("#'.$path.'").parent().find("#img_thumb").addClass("thumb_div");
        }
        $(document).ready(function(){
            if($("#'.$path.'").val()!=""){
                var thumb_path=get_thumb_path("/"+$("#'.$path.'").val());
                $("#'.$path.'").parent().find("#img_thumb").css(
                    "background-image",
                    "url(\''.  base_url().'"+thumb_path+"\')"
                    );
                $("#'.$path.'").parent().find("#img_thumb").addClass("thumb_div");
            }
        });
        
    </script>
';
}

function load_file_finder($path,$browse='BrowseServer',$set_file='SetFileField') {
    ?>
<?php if($browse=='BrowseServer'){ ?>
<script type="text/javascript" src="<?php echo base_url() ?>ckfinder/ckfinder.js"></script>
<?php } ?>
    <script type="text/javascript">

        function <?php echo $browse ?>()
        {
            // You can use the "CKFinder" class to render CKFinder in a page:
            var finder = new CKFinder();
            finder.basePath = site_url('ckfinder');	// The path for the installation of CKFinder (default = "/ckfinder/").
            finder.selectActionFunction = <?php echo $set_file ?>;
            finder.popup();

            // It can also be done in a single line, calling the "static"
            // Popup( basePath, width, height, selectFunction ) function:
            // CKFinder.Popup( '../../', null, null, SetFileField ) ;
            //
            // The "Popup" function can also accept an object as the only argument.
            // CKFinder.Popup( { BasePath : '../../', selectActionFunction : SetFileField } ) ;
        }

        // This is a sample function which is called when a file is selected in CKFinder.
        function <?php echo $set_file ?>( fileUrl )
        {
            document.getElementById( "<?php echo $path ?>" ).value = fileUrl;
                        
            var thumb_path=get_thumb_path(fileUrl);
            
            $('#<?php echo $path ?>').parent().find('#img_thumb').css("background-image", "url('"+thumb_path+"')");
            $('#<?php echo $path ?>').parent().find('#img_thumb').addClass("thumb_div");
        }
        
    </script>
    <?
}

function page_thumb($path) {

    $exploded = explode("/", $path);


    $img = $exploded[count($exploded) - 1];
    //$img_folder=$exploded[count($exploded)-2];

    $exploded[count($exploded) - 2] = "_thumbs";
    $exploded[count($exploded) - 1] = "Images";
    $exploded[count($exploded)] = "$img";

    return implode("/", $exploded);
}

function n2nl($str){
    return str_replace('
', '<br>', $str);
}
    ?>
