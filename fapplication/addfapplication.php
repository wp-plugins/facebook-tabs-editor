<?php
ob_start();

function init_add_fapplication() {
    if (isset($_REQUEST['action']))
        $action = $_REQUEST['action'];
    else
        $action = '';
    ?>
    <style type="text/css">
        #fapplication_title{
            font-size: 1.7em;
            line-height: 100%;
            outline: 0 none;
            padding: 8px 8px;
            width: 803px;
            height: 18px;
            border: 1px solid #CCCCCC;
            color: #BBBBBB;
        }
        #rightcolumn{
            float:right; 
            width: 20%;
            margin-top: 18px;
            margin-right: 15px;
        }

        .leftpartofsite{
            float:left; 
            width: 78%;
        }

        #rightcolumn h3, .metabox-holder h3 
        {
            font-size: 15px;
            font-weight: normal;
            line-height: 1;
            margin: 0;
            padding: 7px 10px;
        }
    </style>
    <div class="sg_builder_container">
        <div id="page_welcome">
            <?php
            switch ($action) {
                case 'deletefapplication':
                    deletefapplication();
                    break;
                case 'savefapplication':
                    savefapplication();
                default:
                    addfapplication();
            }
            ?>    	
        </div>
    </div><?php
    }

    function createThumbnailfapplication($src_img_file, $width, $height, $auto, $dest_img_file) {

        require_once(dirname(__FILE__) . '/class/phpthumb.class.php');

        $phpThumb = new phpThumb();
        @$phpThumb->setSourceData(file_get_contents($src_img_file));


        $phpThumb->setParameter('w', $width);
        $phpThumb->setParameter('h', $height);
        $phpThumb->setParameter('zc', $auto);
        if ($phpThumb->GenerateThumbnail()) {
            // this line is VERY important, do not remove it!
            $phpThumb->RenderToFile($dest_img_file);
        }
    }

    function addfapplication() {
            ?>

    <script type="text/javascript" src="<?php echo get_bloginfo('url'); ?>/wp-content/plugins/facebook-tabs-editor/js/nicEdit-latest.js"></script> 
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            new nicEditor({fullPanel : true}).panelInstance('designation');
        });
    </script>
    <div class="wrap">  
        <br/><br/>
        <div class="icon32" id="icon-edit-pages"><br></div>
        <h2><?php
    if (!empty($_REQUEST['ID'])) {
        _e('Edit Page');
    } else {
        _e('Add Page');
    }
            ?></h2>
        <br/><br/>
    </div>
    <?php
    $my_theme = get_template_directory();
    $pluginfileone = $my_theme . '/facebook-page.php';
    $pluginfiletwo = $my_theme . '/facebook-blog.php';
    $pluginfilethree = $my_theme . '/facebook-contact.php';
    $newcontent = file_get_contents($pluginfileone, true);

    $my_theme_url = get_bloginfo('template_url') . '/facebook-page.php';

    if ($_GET['ID'] == '1') {
        $fbwptitle = 'Facebook About';
    } elseif ($_GET['ID'] == '2') {
        $fbwptitle = 'Facebook Blog';
    } elseif ($_GET['ID'] == '3') {
        $fbwptitle = 'Facebook Contact';
    } else {
        $fbwptitle = 'no page selected...';
    }

    if ($_GET['ID'] == '1') {
        $newcontent = file_get_contents($pluginfileone, true);
    } elseif ($_GET['ID'] == '2') {
        $newcontent = file_get_contents($pluginfiletwo, true);
    } elseif ($_GET['ID'] == '3') {
        $newcontent = file_get_contents($pluginfilethree, true);
    } else {
        $newcontent = 'no page selected...';
    }
    ?>


    <div id="poststuff" class="leftpartofsite">

        <form action="" method="post" name="addForm" enctype="multipart/form-data" onsubmit="return fapplicationformValidation();">
            <input type="hidden" name="action" value="savefapplication" />
            <table width="826" border="0" cellspacing="5" cellpadding="5">
                <tr>
                    <td>
                        <input type="hidden" name="fapplication_title" id="fapplication_title" value="<?php echo $fapplication_title; ?>"/>
                        <div id="fapplication_title"><?php echo $fbwptitle; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea id="designation" style="min-width: 826px;min-height: 760px;" name="designation">
    <?php echo $newcontent; ?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td align="center">&nbsp;
                        
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <input type="submit" class="button-primary" style="min-width: 80px;" value="Update Page" name="add_fapplication" align="right"/>
                    </td>
                </tr>
            </table>


    </div><!--end poststuff-->

    </form>
    <?php
}

function savefapplication() {
    $whichPage = basename($_SERVER['PHP_SELF']);
    $pagecontent = $_POST['designation'];

    $my_theme = get_template_directory();
    $pluginfileone = $my_theme . '/facebook-page.php';

    if ($_GET['ID'] == '1') {
        $my_theme_url = $my_theme . '/facebook-page.php';
    } elseif ($_GET['ID'] == '2') {
        $my_theme_url = $my_theme . '/facebook-blog.php';
    } elseif ($_GET['ID'] == '3') {
        $my_theme_url = $my_theme . '/facebook-contact.php';
    }

    $filecontent = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">' .
            stripslashes($pagecontent) . '</html>';

    file_put_contents($my_theme_url, $filecontent);
    wp_redirect('admin.php?page=fapplication/managefapplication.php');
}

function deletefapplication() {
    global $wpdb, $msg;
    $id = $_REQUEST['ID'];

    $sql = "select * from " . ARTICLES_TABLE . " where fapplication_id = " . $id;
    $row = $wpdb->get_row($sql);

    $delete = "delete from " . ARTICLES_TABLE . " where fapplication_id = " . $id;
    $delete = $wpdb->prepare($delete);
    $wpdb->query($delete);

    unlink('../' . ARTICLES_IMAGE_DIR . $row->fapplication_image);
    unlink('../' . ARTICLES_IMAGE_THUMB_DIR . $row->fapplication_image);

    wp_redirect('admin.php?page=fapplication/managefapplication.php');
}

add_shortcode('art-works', 'init_add_fapplication');
?>