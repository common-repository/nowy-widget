<?php
    wp_enqueue_style( 'admin-nowy-setting-style-style' );
    wp_enqueue_script( 'admin-nowy-underscore-js' );
    wp_enqueue_script( 'admin-nowy-bootstrap-js' );
    wp_enqueue_style( 'admin-nowy-bootstrap-style' );
?>
<div class="noway-main">
    <div class="container-md">
        <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Please login with Nowy account</h5>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Username:</label>
                                <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="user-password" class="col-form-label">Password:</label>
                                <input type="password" class="form-control" id="user-password">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="login()">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="card" style="min-width: 800px;">
                <div class="card-body">
                    <h5 class="card-title">Base Config - Set your widget <button type="button" class="btn btn-warning btn-sm" style="line-height: 1.3" onclick="logout()">Log out</button></h5>
                    <div>
                        <div class="card-text">shortcode: <span style="font-weight:bold" id="shortcode"></span></div>
                        <br/>
                        <div class="card-text" style="display: flex">Max Post: <span>&nbsp;<input id="maxPost" value="30" type="number"/> </span>
                            &nbsp;<button type="button" class="btn btn-primary btn-sm"  onclick="saveMaxPost()">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="d-flex">
            <div class="card" style="min-width: 800px;">
                <div class="card-body">
                    <h5 class="card-title">Source - Your data will be read according to the following condition settings which are set in an 'or' relationship</h5>
                    <div>
                        <div class="card-text">@User - search post from following users (by default from widget user account)</div>
                        <div class="form-check form-check-inline">
                            <div id="user" style="display: flex;flex-wrap: wrap">

                            </div>
                            <button type="button" class="btn btn-danger btn-sm btn-add" data-toggle="modal" onclick="handleOpen('filter','user')" data-target="#exampleModal">Add</button>
                        </div>
                    </div>
                    <div>
                        <div class="card-text">^ Place - search post include following place</div>
                        <div class="form-check form-check-inline">
                            <div id="place" style="display: flex;flex-wrap: wrap">
                            </div>
                            <button type="button" class="btn btn-danger btn-sm  btn-add" data-toggle="modal" onclick="handleOpen('filter','place')" data-target="#exampleModal">Add</button>
                        </div>
                    </div>
                    <div>
                        <div class="card-text"># Topic - search post include following tags</div>
                        <div class="form-check form-check-inline">
                            <div id="topic" style="display: flex;flex-wrap: wrap">
                            </div>
                            <button type="button" class="btn btn-danger btn-sm  btn-add" data-toggle="modal" onclick="handleOpen('filter','topic')" data-target="#searchModal">Add</button>
                        </div>
                    </div>
                    <div>
                        <div class="card-text">Specify post - The specified post will be topped</div>
                        <div class="form-check form-check-inline">
                            <div id="top" style="display: flex;flex-wrap: wrap">
                            </div>
                            <button type="button" class="btn btn-danger btn-sm  btn-add" data-toggle="modal" onclick="handleOpen('filter','top')" data-target="#searchModal">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>

        <div class="d-flex">
            <div class="card" style="min-width: 800px;">
                <div class="card-body">
                    <div>
                        <h5 class="card-title">Order - Your data will be order by the following condition settings please select one</h5>
                        <div class="form-check form-check-inline">
                            <span id="blc-false" class="badge badge-pill badge-light" style="cursor: pointer" onclick="handleBlock('byOrder','blc',true)">By like count</span>&nbsp;
                            <span id="blc-true" class="badge badge-pill badge-dark" style="cursor: pointer;display: none" onclick="handleBlock('byOrder','blc',false)">By like count</span>&nbsp;
                            <span id="bcc-false" class="badge badge-pill badge-light" style="cursor: pointer" onclick="handleBlock('byOrder','bcc',true)">By collect count</span>
                            <span id="bcc-true" class="badge badge-pill badge-dark" style="cursor: pointer;display: none " onclick="handleBlock('byOrder','bcc',false)">By collect count</span>
                            <span id="bn-false" class="badge badge-pill badge-light" style="cursor: pointer" onclick="handleBlock('byOrder','bn',true)">By New</span>&nbsp;
                            <span id="bn-true" class="badge badge-pill badge-dark" style="cursor: pointer;display: none" onclick="handleBlock('byOrder','bn',false)">By New</span>&nbsp;

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="d-flex">
            <div class="card" style="min-width: 800px;">
                <div class="card-body">
                    <h5 class="card-title">Black List - The data will be blocked by the following condition settings</h5>
                    <div>
                        <div class="card-text">User - block post from following users</div>
                        <div class="form-check form-check-inline">
                            <div id="block-user" style="display: flex;flex-wrap: wrap">
                            </div>
                            <button type="button" class="btn btn-danger btn-sm btn-add" data-toggle="modal" onclick="handleOpen('block','blockUser')" data-target="#exampleModal">Add</button>
                        </div>
                        <br/>
                        <div class="card-text">Post - block specific post</div>
                        <div class="form-check form-check-inline">
                            <div id="block-post" style="display: flex;flex-wrap: wrap">
                            </div>
                            <button type="button" class="btn btn-danger btn-sm  btn-add" data-toggle="modal" onclick="handleOpen('block','blockPost')" data-target="#searchModal">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">key word</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Keyword" id="username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveUser()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="searchModalLabel">key word</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="display: flex">
                        <input type="text" class="form-control" placeholder="Search key word" id="searchTitle" aria-describedby="basic-addon1">
                        &nbsp;<button type="button" class="btn btn-success btn-sm" style="line-height: 1.3" onclick="search()">Search</button>
                    </div>
                    <div id="search-result" style="padding: 0 16px">
                        <div class="list-group" id="list-searchResults" role="tablist">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveSearchKey()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="application/javascript">
        let handleType = ''
        let condition = ''
        let configs = {}
        let blcId = ''
        let bccId = ''
        let bnId = ''
        let bcmId = ''
        let shortId= ''
        let limit = 30
        let limitObjectId = ''
        const serverUrl = 'https://api.nowy.io/'
        jQuery(document).ready(function () {
            shortId = getCookie('nowy-user')
            if(!shortId){
                jQuery('#userModal').modal({backdrop: 'static', keyboard: false}, 'show');
            }else{
                queryConfigs()
            }

            setTimeout(() => {
                // Click to Copied
                const textElement = document.getElementById("copy");
                const copyButton = document.getElementById("copy");

                const copyText = (e) => {
                window.getSelection().selectAllChildren(textElement);
                document.execCommand("copy");
                e.target.setAttribute("tooltip", "Copied! ✅");
                };

                const resetTooltip = (e) => {
                e.target.setAttribute("tooltip", "Click to copy shortcode");
                };

                copyButton.addEventListener("click", (e) => copyText(e));
                copyButton.addEventListener("mouseover", (e) => resetTooltip(e));
                // Click to Copied
            }, 1500);
            
        })
        jQuery(function () {
            jQuery('[data-toggle="tooltip"]').tooltip()
        })
        function setCookie(name,value,days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days*24*60*60*1000))
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "")  + expires + "; path=/";
        }
        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }
        function eraseCookie(name) {
            document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }

        function queryConfigs(){
            jQuery.post(serverUrl+"widgetConfig/query",{shortId},function(data){
                if(data.code===0){
                    jQuery('#shortcode').empty()
                    configs = _.groupBy(data.data,'condition_col')
                    let users = configs.user
                    let places = configs.place
                    let topics = configs.topic
                    let tops = configs.top
                    let blockUsers = configs.blockUser
                    let blockPosts = configs.blockPost
                    let byOrders = configs.byOrder
                    let limits = configs.limit
                    if(limits&&limits.length>0){
                        limit = parseInt(limits[0].condition_val)
                        limitObjectId = limits[0].objectId
                    }
                    jQuery('#shortcode').append(`<span id="copy" tooltip="Click to Copy" >[nowy_widget id="${shortId}"] <b class='text-muted ml-2 wp-menu-image dashicons-before dashicons-admin-page' aria-hidden='true'></b></span>`)
                    // jQuery('#shortcode').append(`<span>[nowy_widget id="${shortId}"]</span>`)
                    jQuery('#maxPost').val(limit)
                    jQuery('#blc-true').hide()
                    jQuery('#bcc-true').hide()
                    jQuery('#bn-true').hide()
                    jQuery('#bcm-true').hide()
                    jQuery('#user').empty()
                    users&&users.map(user=>{
                        jQuery('#user').append(`<div class="tag-container" onclick="removeCon('${user.objectId}')"  data-toggle="tooltip" data-placement="top" title="Remove"><span class="badge badge-pill badge-info">${user.condition_val}</span></div>`)
                    })
                    jQuery('#place').empty()
                    places&&places.map(place=>{
                        jQuery('#place').append(`<div class="tag-container" onclick="removeCon('${place.objectId}')"  data-toggle="tooltip" data-placement="top" title="Remove"><span class="badge badge-pill badge-warning">${place.condition_val}</span></div>`)
                    })
                    jQuery('#topic').empty()
                    topics&&topics.map(topic=>{
                        jQuery('#topic').append(`<div class="tag-container" onclick="removeCon('${topic.objectId}')"  data-toggle="tooltip" data-placement="top" title="Remove"><span class="badge badge-pill badge-success">${topic.condition_val}</span></div>`)
                    })
                    jQuery('#top').empty()
                    tops&&tops.map(top=>{
                        jQuery('#top').append(`<div class="tag-container" onclick="removeCon('${top.objectId}')"  data-toggle="tooltip" data-placement="top" title="Remove"><span class="badge badge-pill badge-primary">${top.condition_val}</span></div>`)
                    })
                    jQuery('#block-user').empty()
                    blockUsers&&blockUsers.map(bUser=>{
                        jQuery('#block-user').append(`<div class="tag-container" onclick="removeCon('${bUser.objectId}')"><span class="badge badge-pill badge-primary">${bUser.condition_val}</span></div>`)
                    })
                    jQuery('#block-post').empty()
                    blockPosts&&blockPosts.map(bPosts=>{
                        jQuery('#block-post').append(`<div class="tag-container" onclick="removeCon('${bPosts.objectId}')"><span class="badge badge-pill badge-secondary">${bPosts.condition_val}</span></div>`)
                    })
                    if(byOrders){
                        byOrders.map(bo=>{
                            if(bo.type==='blc'){
                                if(bo.condition_val==='true'){
                                    blcId = bo.objectId
                                    jQuery('#blc-true').show()
                                    jQuery('#blc-false').hide()
                                }else{
                                    blcId = bo.objectId
                                    jQuery('#blc-true').hide()
                                    jQuery('#blc-false').show()
                                }
                            }
                            if(bo.type==='bcc'){
                                if(bo.condition_val==='true'){
                                    bccId = bo.objectId
                                    jQuery('#bcc-true').show()
                                    jQuery('#bcc-false').hide()
                                }else{
                                    bccId = bo.objectId
                                    jQuery('#bcc-true').hide()
                                    jQuery('#bcc-false').show()
                                }
                            }
                            if(bo.type==='bn'){
                                if(bo.condition_val==='true'){
                                    bnId = bo.objectId
                                    jQuery('#bn-true').show()
                                    jQuery('#bn-false').hide()
                                }else{
                                    bnId = bo.objectId
                                    jQuery('#bn-true').hide()
                                    jQuery('#bn-false').show()
                                }
                            }
                            if(bo.type==='bcm'){
                                if(bo.condition_val==='true'){
                                    bcmId = bo.objectId
                                    jQuery('#bcm-true').show()
                                    jQuery('#bcm-false').hide()
                                }else{
                                    bcmId = bo.objectId
                                    jQuery('#bcm-true').hide()
                                    jQuery('#bcm-false').show()
                                }
                            }
                        })
                    }
                }else{
                    alert('init error. pls contact admin.')
                }
            })
        }

        function saveUser(){
            let cval = jQuery('#username').val();
            if(cval.trim()!==''){
                jQuery.post( serverUrl+"widgetConfig/save", {
                    type:handleType,
                    condition_col:condition,
                    condition_val:cval,
                    shortId,
                },function( data ) {
                    if(data.code===0){
                        jQuery('#exampleModal').modal('hide')
                        queryConfigs()
                    }else{
                        alert(data.msg)
                    }
                });
            }
        }

        function saveSearchKey(){
            let cval = jQuery('#list-searchResults a.active input').val();
            if(cval!==''){
                jQuery.post( serverUrl+"widgetConfig/save", {
                    type:handleType,
                    condition_col:condition,
                    condition_val:cval,
                    shortId,
                },function( data ) {
                    if(data.code===0){
                        jQuery('#searchModal').modal('hide')
                        queryConfigs()
                    }else{
                        alert(data.msg)
                    }
                });
            }else{
                alert("Please type in key word for search firstly.")
            }
        }

        function search(){
            let searchVal = jQuery('#searchTitle').val()
            if(searchVal.length<3){
                alert('Please enter more than 2 characters.')
            }else{
                if(condition === 'topic'){
                    jQuery.post( serverUrl+"posts/searchTopic", {
                        keyword: searchVal,
                    },function( data ) {
                        if(data.code===0){
                            if(data.data.length>0){
                                jQuery('#list-searchResults').empty();
                                let searchResults = data.data;
                                searchResults.map((sr,idx)=>{
                                    if (idx === 0) {
                                        jQuery('#list-searchResults').append(`<a class="list-group-item list-group-item-action active"
                                                        data-toggle="list" role="tab"><input style="width:0;visibility: hidden" type="text" value="${sr.topic}"/>${sr.topic}</a>`);
                                    }else{
                                        jQuery('#list-searchResults').append(`<a class="list-group-item list-group-item-action"
                                                        data-toggle="list" role="tab"><input style="width:0;visibility: hidden" type="text" value="${sr.topic}"/>${sr.topic}</a>`);
                                    }
                                })
                            }
                            else{
                                alert("Can't find any data. Please use another key word to have a try")
                            }
                        }
                    });
                }else{
                    jQuery.post( serverUrl+"posts/search", {
                        keyword: searchVal,
                    },function( data ) {
                        if(data.code===0){
                            if(data.data.length>0){
                                jQuery('#list-searchResults').empty();
                                let searchResults = data.data;
                                searchResults.map((sr,idx)=>{
                                    if (idx === 0) {
                                        jQuery('#list-searchResults').append(`<a class="list-group-item list-group-item-action active"
                                                        data-toggle="list" role="tab"><input style="width:0;visibility: hidden" type="text" value="${sr.title}"/>${sr.title}</a>`);
                                    }else{
                                        jQuery('#list-searchResults').append(`<a class="list-group-item list-group-item-action"
                                                        data-toggle="list" role="tab"><input style="width:0;visibility: hidden" type="text" value="${sr.title}"/>${sr.title}</a>`);
                                    }
                                })
                            }
                            else{
                                alert("Can't find any data. Please use another key word to have a try")
                            }
                        }
                    });
                }
            }
        }

        function  handleOpen(type,val){
            jQuery('#username').val('')
            jQuery('#list-searchResults').empty()
            jQuery('#searchTitle').val('')
            handleType = type
            condition = val
        }

        function saveMaxPost(){
            let mp = jQuery('#maxPost').val()
            if(mp == 0 || mp < 0 ){
                alert('Minimum post limit is 1.')
                return
            }
            if(mp>400){
                alert('Max post limit is 400.')
                return
            }
            jQuery.post( serverUrl+"widgetConfig/update", {
                type:'limit',
                condition_col:'limit',
                condition_val: mp,
                shortId,
                objectId: limitObjectId,
            },function( data ) {
                if(data.code===0){
                    alert('Save successfully.')
                    limitObjectId = data.objectId
                    queryConfigs()
                }
            });
        }

        function logout(){
            eraseCookie('nowy-user')
            alert('Log out successfully.')
            window.location.reload()
        }

        function removeCon(conId){
            jQuery.ajax({
                url: serverUrl+"widgetConfig/delete",
                data:{objectId:conId},
                type: 'DELETE',
                success: function(data) {
                    if(data.code===0){
                        alert('Remove successfully.')
                        queryConfigs()
                    }else{
                        alert('Remove failure. Please try again.')
                    }
                }
            });
        }

        function login(){
            let username = jQuery('#recipient-name').val()
            let password = jQuery('#user-password').val()
			
            jQuery.post( serverUrl+"users/login", {username,password},function(data ) {
                if(data.code===0){
                    shortId = data.data.shortId;
                    jQuery('#shortcode').append(`<span id="copy" tooltip="Click to Copy">[nowy_widget id="${shortId}"] <b class='text-muted ml-2 wp-menu-image dashicons-before dashicons-admin-page' aria-hidden='true'></b></span>`)
                    // jQuery('#shortcode').append(`<span>[nowy_widget id="${shortId}"]</span>`)
                    setCookie('nowy-user',shortId)
                    jQuery('#userModal').modal('hide')
                    queryConfigs()
                }else{
                    alert(' Username or password is not correct. Please try again.');
                }
            });
        }

        function handleBlock(type,val,isOpen){
            let updateId = ''
            if(val === 'blc'){
                updateId = blcId
            }else if(val==='bcc'){
                updateId = bccId
            }else if(val==='bn'){
                updateId = bnId
            }else{
                updateId = bcmId
            }
            let newVar = {
                type:val,
                condition_col:type,
                shortId,
                condition_val:isOpen,
                objectId: updateId,
            };
            jQuery.post( serverUrl+"widgetConfig/update", newVar,function(data ) {
                if(data.code===0){
                    queryConfigs()
                }
            });
        }
    </script>
    <footer>
        <p><a href="https://nowy.io" target="_blank" rel="noopener noreferrer" class="footer-link">Powered by Nowy <img style="width:24px" src="<?php echo plugins_url( '/assets/novylogo-2-min.png', __FILE__ ); ?>"/></a></p>
    </footer>
</div>
