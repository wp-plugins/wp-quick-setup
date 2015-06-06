<style>
    .parsley-errors-list{
        margin-top: -10px;
        color: red;
    }
</style>
<div class="outer-wrapper wp-easy-setup">
    <div class="header">
        <h2 style="color:#fff;"><b>WP Quick Setup</b></h2>
    </div>
    <div class="wrapper">
        <h4 class="jp-text">The quick and easy way to start up your new WordPress website</h4>
    </div>
    <br>
    
    <div class="row">
        <div class="col s10">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"></th>
                        <td>
                            <form action="action">
                                <h4>Choose between the following:</h4>
                                <div>
                                    <input id="select-all" class="select-all" type="checkbox">
                                    <label for="select-all">Select All</label>
                                </div>
                                <hr>
                                <div>
                                    <input id="juqs_permalinks" name="change_permalink" type="checkbox">
                                    <label for="juqs_permalinks">Change the permalink structure to /%postname%/</label>
                                </div>
                                <div>
                                    <input id="juqs_uploads" name="upload_path" type="checkbox">
                                    <label for="juqs_uploads">Deselect the option "Organize my uploads in to month- and year based folders"<br></label>
                                </div>
                                <div>
                                    <input id="juqs_hellodolly" name="delete_hello_dolly" type="checkbox">
                                    <label for="juqs_hellodolly">Delete the "Hello Dolly" plugin<br></label>
                                </div>
                                <div>
                                    <input id="juqs_akismet" name="activate_akismet"  type="checkbox">
                                    <label for="juqs_akismet">Activate the Akismet plugin<br></label>
                                </div>
                                <div>
                                    <input id="juqs_delpost_page" name="delete_sample" type="checkbox">
                                    <label for="juqs_delpost_page">Delete sample post, sample page and sample comment (dummy content)<br></label>
                                </div>
                                <div>
                                    <input id="juqs_registration" name="disable_user_registration" type="checkbox">
                                    <label for="juqs_registration">Disable user registration<br></label>
                                </div>
                                <div>
                                    <input type="checkbox" name="empty_trash" id="empty-trash">
                                    <label for="empty-trash">Empty the trash for the deleted dummy content: plugin, page, post and comment</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="delete_default_theme" id="delete-default-theme">
                                    <label for="delete-default-theme">Delete standard themes, except for the one that is used</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="crawl_search_engine" id="crawl-search-engine">
                                    <label for="crawl-search-engine">Disallow the search engines crawl the site</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="email_on_comment" id="email-on-comment">
                                    <label for="email-on-comment">Disallow email when people comment, or if there is a comment waiting for approval</label>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col s2">
                                        <h6>Preferred Domain</h6>
                                    </div>
                                    <div class="col s4">
                                        <input placeholder="Enter Preferred domain" value="<?php echo esc_attr(get_option('home')); ?>" 
                                               name="preferred_domain" id="preffered_domain" type="url" class="validate">
                                    </div>
                                </div>
                                <button type="button" class="waves-effect waves-light btn do-quick-setup">Quick Setup</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td>
                            <h4>Front page and posts page options</h4>
                            <div class="row">
                                <div class="col s6">
                                    <legend class="screen-reader-text"><span>Front page displays</span></legend>
                                    <p>
                                        <label>
                                            <?php
                                            $juqs_checked_posts = "";
                                            if (get_option("show_on_front") == "posts") {
                                                $juqs_checked_posts = "checked";
                                            }
                                            ?>

                                            <input id="show_on_front_1" name="show_on_front" type="radio" value="posts" class="tog" <?php echo $juqs_checked_posts; ?>>
                                            <label for="show_on_front_1">Your latest post</label>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            <?php
                                            $juqs_checked_page = "";
                                            if (get_option("show_on_front") == "page") {
                                                $juqs_checked_page = "checked";
                                            }
                                            ?>
                                            <input id="show_on_front_2" name="show_on_front" type="radio" value="page" class="tog" <?php echo $juqs_checked_page; ?>>
                                            <label for="show_on_front_2">A <a href="edit.php?post_type=page">static page</a> (select below)</label>	
                                        </label>
                                    </p>
                                    <ul>
                                        <li>
                                            <label for="page_on_front">Front page: </label>
                                            <select class="browser-default" name="page_on_front" id="page_on_front">
                                                <option value="0">— Select —</option>
                                                <?php
                                                $juqs_query = new WP_Query(array('post_type' => 'page', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1));
                                                if ($juqs_query->have_posts()) {

                                                    while ($juqs_query->have_posts()) {
                                                        $juqs_query->the_post();
                                                        $juqs_page_selected = "";
                                                        $juqs_page_style = "";
                                                        if (get_the_id() == get_option("page_on_front")) {
                                                            $juqs_page_selected = "selected";
                                                        }
                                                        echo "<option value='" . get_the_id() . "' $juqs_page_selected>" . get_the_title() . "</option>";
                                                    }
                                                    wp_reset_postdata();
                                                }
                                                ?>
                                            </select>

                                        </li>
                                        <li>
                                            <label for="page_for_posts">Posts page: </label>
                                            <select class="browser-default" name="page_for_posts" id="page_for_posts">
                                                <option value="0">— Select —</option>
                                                <?php
                                                $juqs_query = new WP_Query(array('post_type' => 'page', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1));
                                                if ($juqs_query->have_posts()) {

                                                    while ($juqs_query->have_posts()) {
                                                        $juqs_query->the_post();
                                                        $juqs_page_selected = "";
                                                        $juqs_page_style = "";
                                                        if (get_the_id() == get_option("page_for_posts")) {
                                                            $juqs_page_selected = "selected";
                                                        }
                                                        echo "<option value='" . get_the_id() . "' $juqs_page_selected>" . get_the_title() . "</option>";
                                                    }
                                                    wp_reset_postdata();
                                                }
                                                ?>

                                            </select>
                                        </li>
                                    </ul>
                                    <hr>
                                    <br >
                                    <p>For each article in a feed, show:</p>
                                    <div>
                                        <input type="radio" id="full-text" value="0" name="rss_use_excerpt"/>
                                        <label for="full-text">Full text</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="summary" value="1" name="rss_use_excerpt"/>
                                        <label for="summary">Summary</label>
                                    </div>
                                    <br />
                                    <button class="waves-effect waves-light btn save-front-page">Save</button>
                                </div>
                            </div>
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td>
                            <h4>Timezone</h4>
                            <div class="row">
                                <div class="input-field col s3">
                                    <select class="browser-default" id="juqs_timezone_string" name="timezone_string">
                                        <option value="">Choose city</option>
                                        <optgroup label="Africa">
                                            <option value="Africa/Abidjan">Abidjan</option>
                                            <option value="Africa/Accra">Accra</option>
                                            <option value="Africa/Addis_Ababa">Addis Ababa</option>
                                            <option value="Africa/Algiers">Algiers</option>
                                            <option value="Africa/Asmara">Asmara</option>
                                            <option value="Africa/Bamako">Bamako</option>
                                            <option value="Africa/Bangui">Bangui</option>
                                            <option value="Africa/Banjul">Banjul</option>
                                            <option value="Africa/Bissau">Bissau</option>
                                            <option value="Africa/Blantyre">Blantyre</option>
                                            <option value="Africa/Brazzaville">Brazzaville</option>
                                            <option value="Africa/Bujumbura">Bujumbura</option>
                                            <option value="Africa/Cairo">Cairo</option>
                                            <option value="Africa/Casablanca">Casablanca</option>
                                            <option value="Africa/Ceuta">Ceuta</option>
                                            <option value="Africa/Conakry">Conakry</option>
                                            <option value="Africa/Dakar">Dakar</option>
                                            <option value="Africa/Djuqs_es_Salaam">Dar es Salaam</option>
                                            <option value="Africa/Djibouti">Djibouti</option>
                                            <option value="Africa/Douala">Douala</option>
                                            <option value="Africa/El_Aaiun">El Aaiun</option>
                                            <option value="Africa/Freetown">Freetown</option>
                                            <option value="Africa/Gaborone">Gaborone</option>
                                            <option value="Africa/Harare">Harare</option>
                                            <option value="Africa/Johannesburg">Johannesburg</option>
                                            <option value="Africa/Juba">Juba</option>
                                            <option value="Africa/Kampala">Kampala</option>
                                            <option value="Africa/Khartoum">Khartoum</option>
                                            <option value="Africa/Kigali">Kigali</option>
                                            <option value="Africa/Kinshasa">Kinshasa</option>
                                            <option value="Africa/Lagos">Lagos</option>
                                            <option value="Africa/Libreville">Libreville</option>
                                            <option value="Africa/Lome">Lome</option>
                                            <option value="Africa/Luanda">Luanda</option>
                                            <option value="Africa/Lubumbashi">Lubumbashi</option>
                                            <option value="Africa/Lusaka">Lusaka</option>
                                            <option value="Africa/Malabo">Malabo</option>
                                            <option value="Africa/Maputo">Maputo</option>
                                            <option value="Africa/Maseru">Maseru</option>
                                            <option value="Africa/Mbabane">Mbabane</option>
                                            <option value="Africa/Mogadishu">Mogadishu</option>
                                            <option value="Africa/Monrovia">Monrovia</option>
                                            <option value="Africa/Nairobi">Nairobi</option>
                                            <option value="Africa/Ndjamena">Ndjamena</option>
                                            <option value="Africa/Niamey">Niamey</option>
                                            <option value="Africa/Nouakchott">Nouakchott</option>
                                            <option value="Africa/Ouagadougou">Ouagadougou</option>
                                            <option value="Africa/Porto-Novo">Porto-Novo</option>
                                            <option value="Africa/Sao_Tome">Sao Tome</option>
                                            <option value="Africa/Tripoli">Tripoli</option>
                                            <option value="Africa/Tunis">Tunis</option>
                                            <option value="Africa/Windhoek">Windhoek</option>
                                        </optgroup>
                                        <optgroup label="America">
                                            <option value="America/Adak">Adak</option>
                                            <option value="America/Anchorage">Anchorage</option>
                                            <option value="America/Anguilla">Anguilla</option>
                                            <option value="America/Antigua">Antigua</option>
                                            <option value="America/Araguaina">Araguaina</option>
                                            <option value="America/Argentina/Buenos_Aires">Argentina - Buenos Aires</option>
                                            <option value="America/Argentina/Catamarca">Argentina - Catamarca</option>
                                            <option value="America/Argentina/Cordoba">Argentina - Cordoba</option>
                                            <option value="America/Argentina/Jujuy">Argentina - Jujuy</option>
                                            <option value="America/Argentina/La_Rioja">Argentina - La Rioja</option>
                                            <option value="America/Argentina/Mendoza">Argentina - Mendoza</option>
                                            <option value="America/Argentina/Rio_Gallegos">Argentina - Rio Gallegos</option>
                                            <option value="America/Argentina/Salta">Argentina - Salta</option>
                                            <option value="America/Argentina/San_Juan">Argentina - San Juan</option>
                                            <option value="America/Argentina/San_Luis">Argentina - San Luis</option>
                                            <option value="America/Argentina/Tucuman">Argentina - Tucuman</option>
                                            <option value="America/Argentina/Ushuaia">Argentina - Ushuaia</option>
                                            <option value="America/Aruba">Aruba</option>
                                            <option value="America/Asuncion">Asuncion</option>
                                            <option value="America/Atikokan">Atikokan</option>
                                            <option value="America/Bahia">Bahia</option>
                                            <option value="America/Bahia_Banderas">Bahia Banderas</option>
                                            <option value="America/Barbados">Barbados</option>
                                            <option value="America/Belem">Belem</option>
                                            <option value="America/Belize">Belize</option>
                                            <option value="America/Blanc-Sablon">Blanc-Sablon</option>
                                            <option value="America/Boa_Vista">Boa Vista</option>
                                            <option value="America/Bogota">Bogota</option>
                                            <option value="America/Boise">Boise</option>
                                            <option value="America/Cambridge_Bay">Cambridge Bay</option>
                                            <option value="America/Campo_Grande">Campo Grande</option>
                                            <option value="America/Cancun">Cancun</option>
                                            <option value="America/Caracas">Caracas</option>
                                            <option value="America/Cayenne">Cayenne</option>
                                            <option value="America/Cayman">Cayman</option>
                                            <option value="America/Chicago">Chicago</option>
                                            <option value="America/Chihuahua">Chihuahua</option>
                                            <option value="America/Costa_Rica">Costa Rica</option>
                                            <option value="America/Creston">Creston</option>
                                            <option value="America/Cuiaba">Cuiaba</option>
                                            <option value="America/Curacao">Curacao</option>
                                            <option value="America/Danmarkshavn">Danmarkshavn</option>
                                            <option value="America/Dawson">Dawson</option>
                                            <option value="America/Dawson_Creek">Dawson Creek</option>
                                            <option value="America/Denver">Denver</option>
                                            <option value="America/Detroit">Detroit</option>
                                            <option value="America/Dominica">Dominica</option>
                                            <option value="America/Edmonton">Edmonton</option>
                                            <option value="America/Eirunepe">Eirunepe</option>
                                            <option value="America/El_Salvador">El Salvador</option>
                                            <option value="America/Fortaleza">Fortaleza</option>
                                            <option value="America/Glace_Bay">Glace Bay</option>
                                            <option value="America/Godthab">Godthab</option>
                                            <option value="America/Goose_Bay">Goose Bay</option>
                                            <option value="America/Grand_Turk">Grand Turk</option>
                                            <option value="America/Grenada">Grenada</option>
                                            <option value="America/Guadeloupe">Guadeloupe</option>
                                            <option value="America/Guatemala">Guatemala</option>
                                            <option value="America/Guayaquil">Guayaquil</option>
                                            <option value="America/Guyana">Guyana</option>
                                            <option value="America/Halifax">Halifax</option>
                                            <option value="America/Havana">Havana</option>
                                            <option value="America/Hermosillo">Hermosillo</option>
                                            <option value="America/Indiana/Indianapolis">Indiana - Indianapolis</option>
                                            <option value="America/Indiana/Knox">Indiana - Knox</option>
                                            <option value="America/Indiana/Marengo">Indiana - Marengo</option>
                                            <option value="America/Indiana/Petersburg">Indiana - Petersburg</option>
                                            <option value="America/Indiana/Tell_City">Indiana - Tell City</option>
                                            <option value="America/Indiana/Vevay">Indiana - Vevay</option>
                                            <option value="America/Indiana/Vincennes">Indiana - Vincennes</option>
                                            <option value="America/Indiana/Winamac">Indiana - Winamac</option>
                                            <option value="America/Inuvik">Inuvik</option>
                                            <option value="America/Iqaluit">Iqaluit</option>
                                            <option value="America/Jamaica">Jamaica</option>
                                            <option value="America/Juneau">Juneau</option>
                                            <option value="America/Kentucky/Louisville">Kentucky - Louisville</option>
                                            <option value="America/Kentucky/Monticello">Kentucky - Monticello</option>
                                            <option value="America/Kralendijk">Kralendijk</option>
                                            <option value="America/La_Paz">La Paz</option>
                                            <option value="America/Lima">Lima</option>
                                            <option value="America/Los_Angeles">Los Angeles</option>
                                            <option value="America/Lower_Princes">Lower Princes</option>
                                            <option value="America/Maceio">Maceio</option>
                                            <option value="America/Managua">Managua</option>
                                            <option value="America/Manaus">Manaus</option>
                                            <option value="America/Marigot">Marigot</option>
                                            <option value="America/Martinique">Martinique</option>
                                            <option value="America/Matamoros">Matamoros</option>
                                            <option value="America/Mazatlan">Mazatlan</option>
                                            <option value="America/Menominee">Menominee</option>
                                            <option value="America/Merida">Merida</option>
                                            <option value="America/Metlakatla">Metlakatla</option>
                                            <option value="America/Mexico_City">Mexico City</option>
                                            <option value="America/Miquelon">Miquelon</option>
                                            <option value="America/Moncton">Moncton</option>
                                            <option value="America/Monterrey">Monterrey</option>
                                            <option value="America/Montevideo">Montevideo</option>
                                            <option value="America/Montserrat">Montserrat</option>
                                            <option value="America/Nassau">Nassau</option>
                                            <option value="America/New_York">New York</option>
                                            <option value="America/Nipigon">Nipigon</option>
                                            <option value="America/Nome">Nome</option>
                                            <option value="America/Noronha">Noronha</option>
                                            <option value="America/North_Dakota/Beulah">North Dakota - Beulah</option>
                                            <option value="America/North_Dakota/Center">North Dakota - Center</option>
                                            <option value="America/North_Dakota/New_Salem">North Dakota - New Salem</option>
                                            <option value="America/Ojinaga">Ojinaga</option>
                                            <option value="America/Panama">Panama</option>
                                            <option value="America/Pangnirtung">Pangnirtung</option>
                                            <option value="America/Paramaribo">Paramaribo</option>
                                            <option value="America/Phoenix">Phoenix</option>
                                            <option value="America/Port-au-Prince">Port-au-Prince</option>
                                            <option value="America/Port_of_Spain">Port of Spain</option>
                                            <option value="America/Porto_Velho">Porto Velho</option>
                                            <option value="America/Puerto_Rico">Puerto Rico</option>
                                            <option value="America/Rainy_River">Rainy River</option>
                                            <option value="America/Rankin_Inlet">Rankin Inlet</option>
                                            <option value="America/Recife">Recife</option>
                                            <option value="America/Regina">Regina</option>
                                            <option value="America/Resolute">Resolute</option>
                                            <option value="America/Rio_Branco">Rio Branco</option>
                                            <option value="America/Santa_Isabel">Santa Isabel</option>
                                            <option value="America/Santarem">Santarem</option>
                                            <option value="America/Santiago">Santiago</option>
                                            <option value="America/Santo_Domingo">Santo Domingo</option>
                                            <option value="America/Sao_Paulo">Sao Paulo</option>
                                            <option value="America/Scoresbysund">Scoresbysund</option>
                                            <option value="America/Sitka">Sitka</option>
                                            <option value="America/St_Barthelemy">St Barthelemy</option>
                                            <option value="America/St_Johns">St Johns</option>
                                            <option value="America/St_Kitts">St Kitts</option>
                                            <option value="America/St_Lucia">St Lucia</option>
                                            <option value="America/St_Thomas">St Thomas</option>
                                            <option value="America/St_Vincent">St Vincent</option>
                                            <option value="America/Swift_Current">Swift Current</option>
                                            <option value="America/Tegucigalpa">Tegucigalpa</option>
                                            <option value="America/Thule">Thule</option>
                                            <option value="America/Thunder_Bay">Thunder Bay</option>
                                            <option value="America/Tijuana">Tijuana</option>
                                            <option value="America/Toronto">Toronto</option>
                                            <option value="America/Tortola">Tortola</option>
                                            <option value="America/Vancouver">Vancouver</option>
                                            <option value="America/Whitehorse">Whitehorse</option>
                                            <option value="America/Winnipeg">Winnipeg</option>
                                            <option value="America/Yakutat">Yakutat</option>
                                            <option value="America/Yellowknife">Yellowknife</option>
                                        </optgroup>
                                        <optgroup label="Antarctica">
                                            <option value="Antarctica/Casey">Casey</option>
                                            <option value="Antarctica/Davis">Davis</option>
                                            <option value="Antarctica/DumontDUrville">DumontDUrville</option>
                                            <option value="Antarctica/Macquarie">Macquarie</option>
                                            <option value="Antarctica/Mawson">Mawson</option>
                                            <option value="Antarctica/McMurdo">McMurdo</option>
                                            <option value="Antarctica/Palmer">Palmer</option>
                                            <option value="Antarctica/Rothera">Rothera</option>
                                            <option value="Antarctica/Syowa">Syowa</option>
                                            <option value="Antarctica/Troll">Troll</option>
                                            <option value="Antarctica/Vostok">Vostok</option>
                                        </optgroup>
                                        <optgroup label="Arctic">
                                            <option value="Arctic/Longyearbyen">Longyearbyen</option>
                                        </optgroup>
                                        <optgroup label="Asia">
                                            <option value="Asia/Aden">Aden</option>
                                            <option value="Asia/Almaty">Almaty</option>
                                            <option value="Asia/Amman">Amman</option>
                                            <option value="Asia/Anadyr">Anadyr</option>
                                            <option value="Asia/Aqtau">Aqtau</option>
                                            <option value="Asia/Aqtobe">Aqtobe</option>
                                            <option value="Asia/Ashgabat">Ashgabat</option>
                                            <option value="Asia/Baghdad">Baghdad</option>
                                            <option value="Asia/Bahrain">Bahrain</option>
                                            <option value="Asia/Baku">Baku</option>
                                            <option value="Asia/Bangkok">Bangkok</option>
                                            <option value="Asia/Beirut">Beirut</option>
                                            <option value="Asia/Bishkek">Bishkek</option>
                                            <option value="Asia/Brunei">Brunei</option>
                                            <option value="Asia/Chita">Chita</option>
                                            <option value="Asia/Choibalsan">Choibalsan</option>
                                            <option value="Asia/Colombo">Colombo</option>
                                            <option value="Asia/Damascus">Damascus</option>
                                            <option value="Asia/Dhaka">Dhaka</option>
                                            <option value="Asia/Dili">Dili</option>
                                            <option value="Asia/Dubai">Dubai</option>
                                            <option value="Asia/Dushanbe">Dushanbe</option>
                                            <option value="Asia/Gaza">Gaza</option>
                                            <option value="Asia/Hebron">Hebron</option>
                                            <option value="Asia/Ho_Chi_Minh">Ho Chi Minh</option>
                                            <option value="Asia/Hong_Kong">Hong Kong</option>
                                            <option value="Asia/Hovd">Hovd</option>
                                            <option value="Asia/Irkutsk">Irkutsk</option>
                                            <option value="Asia/Jakarta">Jakarta</option>
                                            <option value="Asia/Jayapura">Jayapura</option>
                                            <option value="Asia/Jerusalem">Jerusalem</option>
                                            <option value="Asia/Kabul">Kabul</option>
                                            <option value="Asia/Kamchatka">Kamchatka</option>
                                            <option value="Asia/Karachi">Karachi</option>
                                            <option value="Asia/Kathmandu">Kathmandu</option>
                                            <option value="Asia/Khandyga">Khandyga</option>
                                            <option value="Asia/Kolkata">Kolkata</option>
                                            <option value="Asia/Krasnoyarsk">Krasnoyarsk</option>
                                            <option value="Asia/Kuala_Lumpur">Kuala Lumpur</option>
                                            <option value="Asia/Kuching">Kuching</option>
                                            <option value="Asia/Kuwait">Kuwait</option>
                                            <option value="Asia/Macau">Macau</option>
                                            <option value="Asia/Magadan">Magadan</option>
                                            <option value="Asia/Makassar">Makassar</option>
                                            <option value="Asia/Manila">Manila</option>
                                            <option value="Asia/Muscat">Muscat</option>
                                            <option value="Asia/Nicosia">Nicosia</option>
                                            <option value="Asia/Novokuznetsk">Novokuznetsk</option>
                                            <option value="Asia/Novosibirsk">Novosibirsk</option>
                                            <option value="Asia/Omsk">Omsk</option>
                                            <option value="Asia/Oral">Oral</option>
                                            <option value="Asia/Phnom_Penh">Phnom Penh</option>
                                            <option value="Asia/Pontianak">Pontianak</option>
                                            <option value="Asia/Pyongyang">Pyongyang</option>
                                            <option value="Asia/Qatar">Qatar</option>
                                            <option value="Asia/Qyzylorda">Qyzylorda</option>
                                            <option value="Asia/Rangoon">Rangoon</option>
                                            <option value="Asia/Riyadh">Riyadh</option>
                                            <option value="Asia/Sakhalin">Sakhalin</option>
                                            <option value="Asia/Samarkand">Samarkand</option>
                                            <option value="Asia/Seoul">Seoul</option>
                                            <option value="Asia/Shanghai">Shanghai</option>
                                            <option value="Asia/Singapore">Singapore</option>
                                            <option value="Asia/Srednekolymsk">Srednekolymsk</option>
                                            <option value="Asia/Taipei">Taipei</option>
                                            <option value="Asia/Tashkent">Tashkent</option>
                                            <option value="Asia/Tbilisi">Tbilisi</option>
                                            <option value="Asia/Tehran">Tehran</option>
                                            <option value="Asia/Thimphu">Thimphu</option>
                                            <option value="Asia/Tokyo">Tokyo</option>
                                            <option value="Asia/Ulaanbaatar">Ulaanbaatar</option>
                                            <option value="Asia/Urumqi">Urumqi</option>
                                            <option value="Asia/Ust-Nera">Ust-Nera</option>
                                            <option value="Asia/Vientiane">Vientiane</option>
                                            <option value="Asia/Vladivostok">Vladivostok</option>
                                            <option value="Asia/Yakutsk">Yakutsk</option>
                                            <option value="Asia/Yekaterinburg">Yekaterinburg</option>
                                            <option value="Asia/Yerevan">Yerevan</option>
                                        </optgroup>
                                        <optgroup label="Atlantic">
                                            <option value="Atlantic/Azores">Azores</option>
                                            <option value="Atlantic/Bermuda">Bermuda</option>
                                            <option value="Atlantic/Canary">Canary</option>
                                            <option value="Atlantic/Cape_Verde">Cape Verde</option>
                                            <option value="Atlantic/Faroe">Faroe</option>
                                            <option value="Atlantic/Madeira">Madeira</option>
                                            <option value="Atlantic/Reykjavik">Reykjavik</option>
                                            <option value="Atlantic/South_Georgia">South Georgia</option>
                                            <option value="Atlantic/Stanley">Stanley</option>
                                            <option value="Atlantic/St_Helena">St Helena</option>
                                        </optgroup>
                                        <optgroup label="Australia">
                                            <option value="Australia/Adelaide">Adelaide</option>
                                            <option value="Australia/Brisbane">Brisbane</option>
                                            <option value="Australia/Broken_Hill">Broken Hill</option>
                                            <option value="Australia/Currie">Currie</option>
                                            <option value="Australia/Darwin">Darwin</option>
                                            <option value="Australia/Eucla">Eucla</option>
                                            <option value="Australia/Hobart">Hobart</option>
                                            <option value="Australia/Lindeman">Lindeman</option>
                                            <option value="Australia/Lord_Howe">Lord Howe</option>
                                            <option value="Australia/Melbourne">Melbourne</option>
                                            <option value="Australia/Perth">Perth</option>
                                            <option value="Australia/Sydney">Sydney</option>
                                        </optgroup>
                                        <optgroup label="Europe">
                                            <option value="Europe/Amsterdam">Amsterdam</option>
                                            <option value="Europe/Andorra">Andorra</option>
                                            <option value="Europe/Athens">Athens</option>
                                            <option value="Europe/Belgrade">Belgrade</option>
                                            <option value="Europe/Berlin">Berlin</option>
                                            <option value="Europe/Bratislava">Bratislava</option>
                                            <option value="Europe/Brussels">Brussels</option>
                                            <option value="Europe/Bucharest">Bucharest</option>
                                            <option value="Europe/Budapest">Budapest</option>
                                            <option value="Europe/Busingen">Busingen</option>
                                            <option value="Europe/Chisinau">Chisinau</option>
                                            <option value="Europe/Copenhagen">Copenhagen</option>
                                            <option value="Europe/Dublin">Dublin</option>
                                            <option value="Europe/Gibraltar">Gibraltar</option>
                                            <option value="Europe/Guernsey">Guernsey</option>
                                            <option value="Europe/Helsinki">Helsinki</option>
                                            <option value="Europe/Isle_of_Man">Isle of Man</option>
                                            <option value="Europe/Istanbul">Istanbul</option>
                                            <option value="Europe/Jersey">Jersey</option>
                                            <option value="Europe/Kaliningrad">Kaliningrad</option>
                                            <option value="Europe/Kiev">Kiev</option>
                                            <option value="Europe/Lisbon">Lisbon</option>
                                            <option value="Europe/Ljubljana">Ljubljana</option>
                                            <option value="Europe/London">London</option>
                                            <option value="Europe/Luxembourg">Luxembourg</option>
                                            <option value="Europe/Madrid">Madrid</option>
                                            <option value="Europe/Malta">Malta</option>
                                            <option value="Europe/Mariehamn">Mariehamn</option>
                                            <option value="Europe/Minsk">Minsk</option>
                                            <option value="Europe/Monaco">Monaco</option>
                                            <option value="Europe/Moscow">Moscow</option>
                                            <option value="Europe/Oslo">Oslo</option>
                                            <option value="Europe/Paris">Paris</option>
                                            <option value="Europe/Podgorica">Podgorica</option>
                                            <option value="Europe/Prague">Prague</option>
                                            <option value="Europe/Riga">Riga</option>
                                            <option value="Europe/Rome">Rome</option>
                                            <option value="Europe/Samara">Samara</option>
                                            <option value="Europe/San_Marino">San Marino</option>
                                            <option value="Europe/Sarajevo">Sarajevo</option>
                                            <option value="Europe/Simferopol">Simferopol</option>
                                            <option value="Europe/Skopje">Skopje</option>
                                            <option value="Europe/Sofia">Sofia</option>
                                            <option value="Europe/Stockholm">Stockholm</option>
                                            <option value="Europe/Tallinn">Tallinn</option>
                                            <option value="Europe/Tirane">Tirane</option>
                                            <option value="Europe/Uzhgorod">Uzhgorod</option>
                                            <option value="Europe/Vaduz">Vaduz</option>
                                            <option value="Europe/Vatican">Vatican</option>
                                            <option value="Europe/Vienna">Vienna</option>
                                            <option value="Europe/Vilnius">Vilnius</option>
                                            <option value="Europe/Volgograd">Volgograd</option>
                                            <option value="Europe/Warsaw">Warsaw</option>
                                            <option value="Europe/Zagreb">Zagreb</option>
                                            <option value="Europe/Zaporozhye">Zaporozhye</option>
                                            <option value="Europe/Zurich">Zurich</option>
                                        </optgroup>
                                        <optgroup label="Indian">
                                            <option value="Indian/Antananarivo">Antananarivo</option>
                                            <option value="Indian/Chagos">Chagos</option>
                                            <option value="Indian/Christmas">Christmas</option>
                                            <option value="Indian/Cocos">Cocos</option>
                                            <option value="Indian/Comoro">Comoro</option>
                                            <option value="Indian/Kerguelen">Kerguelen</option>
                                            <option value="Indian/Mahe">Mahe</option>
                                            <option value="Indian/Maldives">Maldives</option>
                                            <option value="Indian/Mauritius">Mauritius</option>
                                            <option value="Indian/Mayotte">Mayotte</option>
                                            <option value="Indian/Reunion">Reunion</option>
                                        </optgroup>
                                        <optgroup label="Pacific">
                                            <option value="Pacific/Apia">Apia</option>
                                            <option value="Pacific/Auckland">Auckland</option>
                                            <option value="Pacific/Bougainville">Bougainville</option>
                                            <option value="Pacific/Chatham">Chatham</option>
                                            <option value="Pacific/Chuuk">Chuuk</option>
                                            <option value="Pacific/Easter">Easter</option>
                                            <option value="Pacific/Efate">Efate</option>
                                            <option value="Pacific/Enderbury">Enderbury</option>
                                            <option value="Pacific/Fakaofo">Fakaofo</option>
                                            <option value="Pacific/Fiji">Fiji</option>
                                            <option value="Pacific/Funafuti">Funafuti</option>
                                            <option value="Pacific/Galapagos">Galapagos</option>
                                            <option value="Pacific/Gambier">Gambier</option>
                                            <option value="Pacific/Guadalcanal">Guadalcanal</option>
                                            <option value="Pacific/Guam">Guam</option>
                                            <option value="Pacific/Honolulu">Honolulu</option>
                                            <option value="Pacific/Johnston">Johnston</option>
                                            <option value="Pacific/Kiritimati">Kiritimati</option>
                                            <option value="Pacific/Kosrae">Kosrae</option>
                                            <option value="Pacific/Kwajalein">Kwajalein</option>
                                            <option value="Pacific/Majuro">Majuro</option>
                                            <option value="Pacific/Marquesas">Marquesas</option>
                                            <option value="Pacific/Midway">Midway</option>
                                            <option value="Pacific/Nauru">Nauru</option>
                                            <option value="Pacific/Niue">Niue</option>
                                            <option value="Pacific/Norfolk">Norfolk</option>
                                            <option value="Pacific/Noumea">Noumea</option>
                                            <option value="Pacific/Pago_Pago">Pago Pago</option>
                                            <option value="Pacific/Palau">Palau</option>
                                            <option value="Pacific/Pitcairn">Pitcairn</option>
                                            <option value="Pacific/Pohnpei">Pohnpei</option>
                                            <option value="Pacific/Port_Moresby">Port Moresby</option>
                                            <option value="Pacific/Rarotonga">Rarotonga</option>
                                            <option value="Pacific/Saipan">Saipan</option>
                                            <option value="Pacific/Tahiti">Tahiti</option>
                                            <option value="Pacific/Tarawa">Tarawa</option>
                                            <option value="Pacific/Tongatapu">Tongatapu</option>
                                            <option value="Pacific/Wake">Wake</option>
                                            <option value="Pacific/Wallis">Wallis</option>
                                        </optgroup>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="input-field col s1">
                                    -OR-
                                </div>
                                <div class="input-field col s3">
                                    <select class="browser-default" id="juqs_gmt_offset" name="gmt_offset">
                                        <option value="">Choose UTC</option>
                                        <optgroup label="Manual Offsets">
                                            <option value="-12">UTC-12</option>
                                            <option value="-11.5">UTC-11:30</option>
                                            <option value="-11">UTC-11</option>
                                            <option value="-10.5">UTC-10:30</option>
                                            <option value="-10">UTC-10</option>
                                            <option value="-9.5">UTC-9:30</option>
                                            <option value="-9">UTC-9</option>
                                            <option value="-8.5">UTC-8:30</option>
                                            <option value="-8">UTC-8</option>
                                            <option value="-7.5">UTC-7:30</option>
                                            <option value="-7">UTC-7</option>
                                            <option value="-6.5">UTC-6:30</option>
                                            <option value="-6">UTC-6</option>
                                            <option value="-5.5">UTC-5:30</option>
                                            <option value="-5">UTC-5</option>
                                            <option value="-4.5">UTC-4:30</option>
                                            <option value="-4">UTC-4</option>
                                            <option value="-3.5">UTC-3:30</option>
                                            <option value="-3">UTC-3</option>
                                            <option value="-2.5">UTC-2:30</option>
                                            <option value="-2">UTC-2</option>
                                            <option value="-1.5">UTC-1:30</option>
                                            <option value="-1">UTC-1</option>
                                            <option value="-0.5">UTC-0:30</option>
                                            <option value="+0">UTC+0</option>
                                            <option value="+0.5">UTC+0:30</option>
                                            <option value="+1">UTC+1</option>
                                            <option value="+1.5">UTC+1:30</option>
                                            <option value="+2">UTC+2</option>
                                            <option value="+2.5">UTC+2:30</option>
                                            <option value="+3">UTC+3</option>
                                            <option value="+3.5">UTC+3:30</option>
                                            <option value="+4">UTC+4</option>
                                            <option value="+4.5">UTC+4:30</option>
                                            <option value="+5">UTC+5</option>
                                            <option value="+5.5">UTC+5:30</option>
                                            <option value="+5.75">UTC+5:45</option>
                                            <option value="+6">UTC+6</option>
                                            <option value="+6.5">UTC+6:30</option>
                                            <option value="+7">UTC+7</option>
                                            <option value="+7.5">UTC+7:30</option>
                                            <option value="+8">UTC+8</option>
                                            <option value="+8.5">UTC+8:30</option>
                                            <option value="+8.75">UTC+8:45</option>
                                            <option value="+9">UTC+9</option>
                                            <option value="+9.5">UTC+9:30</option>
                                            <option value="+10">UTC+10</option>
                                            <option value="+10.5">UTC+10:30</option>
                                            <option value="+11">UTC+11</option>
                                            <option value="+11.5">UTC+11:30</option>
                                            <option value="+12">UTC+12</option>
                                            <option value="+12.75">UTC+12:45</option>
                                            <option value="+13">UTC+13</option>
                                            <option value="+13.75">UTC+13:45</option>
                                            <option value="+14">UTC+14</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <br >
                            <br >
                            <button class="waves-effect waves-light btn save-timezone">Save</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td>
                            <h4>Choose date and time format:</h4>
                            <div class="row">
                                <div class="col s4">
                                    <label>Date Format:</label>
                                    <div>
                                        <input type="radio" value="F j, Y" name="date_format" id="d_format_1" />
                                        <label for="d_format_1">June 5, 2015</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="Y-m-d" name="date_format" id="d_format_2" />
                                        <label for="d_format_2">2015-06-05</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="m/d/Y" name="date_format" id="d_format_3" />
                                        <label for="d_format_3">06/05/2015</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="d/m/Y" name="date_format" id="d_format_4" />
                                        <label for="d_format_4">05/06/2015</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="custom" name="date_format" id="date_format_custom_radio" />
                                        <label for="date_format_custom_radio">Custom <div></div>
                                            <input value="F j, Y" size="7" name="date_format_custom"> 
                                            <span class="example"></span>
                                            <span class="spinner"></span>
                                        </label>

                                    </div>
                                </div>
                                <div class="col s3">
                                    <label>Time Format:</label>
                                    <div>
                                        <input type="radio" value="g:i a" name="time_format" id="t_format_1" />
                                        <label for="t_format_1"> 7:57 am</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="g:i A" name="time_format" id="t_format_2" />
                                        <label for="t_format_2"> 7:57 AM</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="H:i" name="time_format" id="t_format_3" />
                                        <label for="t_format_3">07:57</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="custom" name="time_format" id="time_format_custom_radio" />
                                        <label for="time_format_custom_radio">Custom <div></div>
                                            <input value="g:i a" size="7" name="time_format_custom">
                                            <span class="example"></span> 
                                            <span class="spinner"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <br >
                            <button class="waves-effect waves-light btn save-dateformat">Save</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td>
                            <form class="col s12">
                                <h4>Create blank pages and categories:</h4>
                                <div class="control-group">     
                                    <div id="create-categories">
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input placeholder="Enter comma separated  categories names." 
                                                       name="categories_names" id="categories_names" type="text" class="validate">
                                                <label for="categories_names">Category names</label>
                                                <button type="button" class="waves-effect waves-light btn create-categories">Create Categories</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">  
                                    <div id="create-blank-pages">
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input placeholder="Enter comma separated  page names." 
                                                       name="blank_page_names" id="page_names" type="text" class="validate">
                                                <label for="blank_page_names">Page names</label>
                                                <button type="button" class="waves-effect waves-light btn create-blank-pages">Create Blank Pages</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td>
                            <h4>Install and activate popular plugins:</h4>
                            <form>
                                <div>
                                    <input id="select-all-2" class="select-all" type="checkbox">
                                    <label for="select-all-2">Select All</label>
                                </div>
                                <hr>
                                <div>
                                    <input id="seo-yoast" name="seo-yoast" type="checkbox" value="https://wordpress.org/plugins/wordpress-seo/">
                                    <label for="seo-yoast">SEO by Yoast</label>
                                </div>
                                <div>
                                    <input id="w3" name="w3" type="checkbox" value="https://wordpress.org/plugins/w3-total-cache/">
                                    <label for="w3">W3 Total Cache</label>
                                </div>
                                <div>
                                    <input id="wp-smush" name="wp-smush" type="checkbox" value="https://wordpress.org/plugins/wp-smushit/">
                                    <label for="wp-smush">WP Smush</label>
                                </div>
                                <div>
                                    <input id="bj-lazy" name="bj-lazy" type="checkbox" value="https://wordpress.org/plugins/bj-lazy-load/">
                                    <label for="bj-lazy">BJ Lazy Load</label>
                                </div>
                                <div>
                                    <input id="broken-link" name="broken-link" type="checkbox" value="https://wordpress.org/plugins/broken-link-checker/">
                                    <label for="broken-link">Broken Link Checker</label>
                                </div>
                                <div>
                                    <input id="google-analytics" name="google-analytics" 
                                           type="checkbox" value="https://wordpress.org/plugins/google-analytics-for-wordpress/">
                                    <label for="google-analytics">Google Analytics by Yoast</label>
                                </div>
                                <div>
                                    <input id="Comments-reloaded" name="Comments-reloaded" 
                                           type="checkbox" value="https://wordpress.org/plugins/subscribe-to-comments-reloaded/">
                                    <label for="Comments-reloaded">Subscribe to Comments reloaded</label>
                                </div>
                                <div>
                                    <input id="WP-Optimize" name="WP-Optimize" 
                                           type="checkbox" value="https://wordpress.org/plugins/wp-optimize/">
                                    <label for="WP-Optimize">WP-Optimize</label>
                                </div>
                                <div>
                                    <input id="BackWPup" name="BackWPup" 
                                           type="checkbox" value="https://wordpress.org/plugins/backwpup/">
                                    <label for="BackWPup">BackWPup</label>
                                </div>
                                <div>
                                    <input id="form-7" name="form-7" 
                                           type="checkbox" value="https://wordpress.org/plugins/contact-form-7/">
                                    <label for="form-7">Content form 7</label>
                                </div>
                                <div>
                                    <input id="Link-Juice" name="Link-Juice" 
                                           type="checkbox" value="https://wordpress.org/plugins/link-juice-keeper/">
                                    <label for="Link-Juice">Link Juice Keeper</label>
                                </div>
                                <div>
                                    <input id="Codestyling" name="Codestyling" 
                                           type="checkbox" value="http://www.code-styling.de/downloads/codestyling-localization-v1.99.25.zip">
                                    <label for="Codestyling">Codestyling Localization</label>
                                </div>
                                <div>
                                    <input id="YARPP" name="YARPP" 
                                           type="checkbox" value="https://wordpress.org/plugins/yet-another-related-posts-plugin/">
                                    <label for="YARPP">Yet Another Related Post Plugin (YARPP)</label>
                                </div>
                                <div>
                                    <input id="SSBA" name="SSBA" 
                                           type="checkbox" value="https://wordpress.org/plugins/simple-share-buttons-adder/">
                                    <label for="SSBA">Simple Share Button Adder</label>
                                </div>
                                <div>
                                    <input id="Comments-Evolved" 
                                           name="Comments-Evolved" type="checkbox" value="https://wordpress.org/plugins/gplus-comments/">
                                    <label for="Comments-Evolved">Comments Evolved</label>
                                </div>
                                <div>
                                    <input id="Pretty-Link-lite" 
                                           name="Pretty-Link-lite" type="checkbox" value="https://wordpress.org/plugins/pretty-link/">
                                    <label for="Pretty-Link-lite">Pretty Link Lite</label>
                                </div>
                                <br >
                                <button type="button" class="waves-effect waves-light btn install-plugins">Install</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                         <th scope="row"></th>
                        <td>
                            <h4>Install plugins and/or themes from URL:</h4>
                            <div class="control-group">  
                                <div id="multiple-plugin">
                                    <div class="row">
                                        <div class="input-field col s9">
                                            <label for="install-plugins-checkbox">Install multiple plugins at once. Enter comma separated URLs</label>
                                            <textarea id="install-plugins-checkbox" 
                                                      class="materialize-textarea" required="" name="plugin_urls" cols="100" rows="3" 
                                                      placeholder="Enter comma separated plugin URLs ( *.zip )"></textarea>
                                            <button type="button" class="waves-effect waves-light btn install-plugin-from-url">Install</button>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <div class="control-group">  
                                <div id="multiple-themes">
                                    <div class="row">
                                        <div class="input-field col s9">
                                            <label for="install-themes-checkbox">Install multiple themes at once. Enter comma separated URLs</label>
                                            <textarea id="install-themes-checkbox" 
                                                      class="materialize-textarea" required name="theme_urls" cols="100" rows="3" 
                                                      placeholder="Enter comma separated theme URLs ( *.zip )"></textarea>
                                            <button type="button" class="waves-effect waves-light btn install-theme-from-url">Install</button>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>