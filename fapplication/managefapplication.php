<?php

function init_manage_fapplication() {
    global $wpdb;
    if (!empty($_REQUEST['fapplication_type'])) {
        $sql = "select * from " . ARTICLES_TABLE . " where fapplication_type='" . $_REQUEST['fapplication_type'] . "'";
    } else {
        $sql = "select * from " . ARTICLES_TABLE;
    }

    //echo $sql;

    $rows = $wpdb->get_results($sql);
    $total = count($rows);
    ?>
    <script language="javascript">
        function deleteProd(url)
        {
            if(confirm("Are You sure to delete"))
            {
                window.location = url;
            }
        }
    </script>
    <div class="sg_builder_container">
        <div id="page_welcome">
            <div class="wrap">  
                <br/><br/>
                <div class="icon32" id="icon-users"><br></div>
                <h2><?php _e('Manage Pages') ?></h2>
                <br/>
                <a href="http://www.codastar.com/" target="_blank"><i>Please click here to register get your Facebook Tabs live. Including templates, advice and support</i></a>
                <br/><br/>
                
            </div>
            <table cellspacing="0" class="wp-list-table widefat fixed users">
                <thead>
                    <tr>
                        <th style="" class="manage-column column-username" id="username" scope="col" width="10%">
                            <a href="#">
                                <span>Item No.</span><span class="sorting-indicator"></span>
                            </a>
                        </th>
                        <th style="" class="manage-column column-name" id="name" scope="col" width="30%">
                            <a href="#">
                                <span>Page</span>
                                <span class="sorting-indicator"></span>
                            </a>
                        </th>
                        <th style="" class="manage-column column-email" id="email" scope="col" width="10%">
                            <a href="#">
                                <span>Action</span>
                                <span class="sorting-indicator"></span>
                            </a>
                        </th>
                         <th style="" class="manage-column column-email" id="email" scope="col" width="50%">
                            <a href="#">
                                <span>Direct link</span>
                                <span class="sorting-indicator"></span>
                            </a>
                        </th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th style="" class="manage-column column-username" scope="col" width="10%">
                            <a href="#">
                                <span>Item No.</span>
                                <span class="sorting-indicator"></span>
                            </a>
                        </th>
                        <th style="" class="manage-column column-name" scope="col" width="30%">
                            <a href="#">
                                <span>Page</span>
                                <span class="sorting-indicator"></span>
                            </a>
                        </th>
                        <th style="" class="manage-column column-email" scope="col" width="10%">
                            <a href="#">
                                <span>Action</span>
                                <span class="sorting-indicator"></span>
                            </a>
                        </th>
                        <th style="" class="manage-column column-email" id="email" scope="col" width="50%">
                            <a href="#">
                                <span>Direct link</span>
                                <span class="sorting-indicator"></span>
                            </a>
                        </th>
                    </tr>
                </tfoot>
                <tbody class="list:user" id="the-list">
                            <tr id="user-<?php echo $ID; ?>" class="<?php echo $class; ?>">
                                <td class="username column-username" width="10%" style="padding: 5px;"><span style="float:left;margin-left: 12px; font-weight: bold;">1</span></td>
                                <td class="name column-name" width="30%"><a href="admin.php?page=fapplication/addfapplication.php&ID=1">Facebook About</a></td>
                                <td class="role column-role" width="10%">
                                    <a href="admin.php?page=fapplication/addfapplication.php&ID=1">Edit</a>
                                </td>
                                <td class="role column-role" width="50%">
                                    <a href="<?php echo get_bloginfo('template_url') . '/facebook-page.php'?>" target="_blank"><?php echo get_bloginfo('template_url') . '/facebook-page.php'?></a>
                                </td>
                            </tr>
                            <tr id="user-<?php echo $ID; ?>" class="<?php echo $class; ?>">
                                <td class="username column-username" width="10%" style="padding: 5px;"><span style="float:left;margin-left: 12px; font-weight: bold;">2</span></td>
                                <td class="name column-name" width="30%"><a href="admin.php?page=fapplication/addfapplication.php&ID=2">Facebook Blog</a></td>
                                <td class="role column-role" width="50%">
                                    <a href="admin.php?page=fapplication/addfapplication.php&ID=2">Edit</a>
                                </td>
                                <td class="role column-role" width="50%">
                                    <a href="<?php echo get_bloginfo('template_url') . '/facebook-blog.php'?>" target="_blank"><?php echo get_bloginfo('template_url') . '/facebook-blog.php'?></a>
                                </td>
                            </tr>
                            <tr id="user-<?php echo $ID; ?>" class="<?php echo $class; ?>">
                                <td class="username column-username" width="10%" style="padding: 5px;"><span style="float:left;margin-left: 12px; font-weight: bold;">3</span></td>
                                <td class="name column-name" width="30%"><a href="admin.php?page=fapplication/addfapplication.php&ID=3">Facebook Contact</a></td>
                                <td class="role column-role" width="10%">
                                    <a href="admin.php?page=fapplication/addfapplication.php&ID=3">Edit</a>
                                </td>
                                <td class="role column-role" width="50%">
                                    <a href="<?php echo get_bloginfo('template_url') . '/facebook-contact.php'?>" target="_blank"><?php echo get_bloginfo('template_url') . '/facebook-contact.php'?></a>
                                </td>
                            </tr>

                </tbody>
            </table>
            <br/>
            <a href="<?php echo get_bloginfo('url') . '/wp-admin/plugin-editor.php?file=wp_fapplication%2Fstyle.css&plugin=wp_fapplication%2Ffapplication.php';?>"><i>Edit css</i></a>
        </div>
    </div><?php
            }
                ?>
