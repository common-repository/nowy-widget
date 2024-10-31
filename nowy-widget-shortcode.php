<div class="noway-main">
    <div class="fixed-header" id="app-nav" style="opacity: 0">
        <a target="_blank" href="https://apps.apple.com/us/app/nowy-best-travel-community/id1621810481" style="text-decoration:none">
            <div class="header-container">
                <img style="width:24px" src="<?php echo plugins_url( '/assets/novylogo-2-min.png', __FILE__ ); ?>"/>&nbsp;&nbsp; View in Nowy app
            </div>
        </a>
    </div>
    <div style="overflow: hidden;padding:0 6px; top:44px;">
        <div id="freewall" style="width:100%;opacity: 0" class="free-wall">
            <?php
            $url = 'https://api.nowy.io/posts/listPro?pageNo=1&pageSize=25&id=' . sanitize_text_field( $atts['id'] );

		/** @var array|WP_Error $response */
		$response = wp_remote_get( $url );

		$content = "";
		if ( is_array( $response ) && ! is_wp_error( $response ) ) {
			$headers = $response['headers']; // array of http header lines
			$content    = $response['body']; // use the content
         }

            $json_data = json_decode($content, true);
            $idx = -1;
            $convertedArray = array();
            foreach ($json_data as $value) {
                $idx = $idx + 1;
                if (isset($value["topics"])) {
                    $topics = $value["topics"];
                }
                if (isset($value["likeUsers"])) {
                    $likeUser = $value["likeUsers"];
                }
                if (isset($value["places"])) {
                    $places = $value["places"];
                }
                if (isset($value["poster"])) {
                    $poster = $value["poster"];
                }
                if (isset($value["thumbnailUrl"])) {
                    $thumbnailUrl = $value["thumbnailUrl"];
                }
                $topic = '';
                $likeCount = '';
                $location = '';
                $header = '';
                if (isset($value["content"])) {
                    $content = $value["content"];
                }
                if (isset($value["imageUrls"])) {
                    $imageUrls = $value["imageUrls"];
                    if(empty($thumbnailUrl)){
                        $thumbnailUrl = $imageUrls[0];
                    }
                }
                if (isset($value["title"])) {
                    $title = $value["title"];
                }
                if (!empty($poster)) {
                    $topic = $poster['displayName'];
                }
                if (!empty($likeUser)) {
                    $likeCount = count($likeUser);
                }
                if (!empty($places)) {
                    if (isset($places[0]['name'])) {
                        $location = $places[0]['name'];
                    }
                }
                if (!empty($poster)) {
                    $header = "";
                    if( isset($poster['avatar'])){
                        $header = $poster['avatar']['url'];
                    }
                    if( isset($poster['avatarUrl'])){
                        $header = $poster['avatarUrl'];
                    }
                    if (empty($header)) {
                        $header = plugins_url( '/assets/default-head.png', __FILE__ );
                    }
                }
                $detail = array('url' => $thumbnailUrl,
                    'topic' => $topic,
                    'places' => $places,
                    'content' => $content,
                    'poster' => $poster,
                    'imageUrls' => $imageUrls,
                    'title' => $title,
                    'objectId' => $value["objectId"]);
                array_push($convertedArray, $detail);
                $idxImg = $idx;
                $idxOverlay = $idx;
                $idxHide = $idx;

                printf("<div class='brick post_container' onclick='showDetail(%s)'>
                        <div class='img-container'>
                            <img src='%s' class='brick-img' onmouseenter='displayOverlay(%s)'/>
                            <div class='img-overlay' id='overlay-%s'  onmouseout='hideOverlay(%s)'>
                            </div>
                            <div class='location'><span><img src='".plugins_url( '/assets/place-marker-black.png', __FILE__ )."'
                                                            style='width: 14px;padding-bottom: 3px;'/></span><span style='font-size:14px;'>%s</span>
                            </div>
                        </div>
                        <div class='content'>%s</div>
                        <div class='info user_container'>
                            <div>
                                <img src='%s' class='header-img'/>
                            </div>
                            <div style='font-size:14px;padding-left:10px;padding-top:2px'>
                                %s
                            </div>
                            <div class='heart-container'>
                                <span style='padding:2px;'><img src='".plugins_url( '/assets/Heart2x.png', __FILE__ )."'
                                                                style='width:25px;height:26px;padding-bottom:2px;'/><span
                                        style='font-size:14px;'>&nbsp;&nbsp;%s&nbsp;&nbsp;</span></span>
                            </div>
                        </div>
                    </div>", $idx, $thumbnailUrl, $idxImg, $idxOverlay, $idxHide, $location, $title, $header, $topic, $likeCount
                );
            }
            ?>
        </div>
        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="top:44px;">
                <div class="modal-content">
                    <div class="text-right">
                        <button type="button" class=" pr-1 close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="previewDiv">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators" id="carousel-idx">
                                        </ol>
                                        <div class="carousel-inner" id="carousel-slider">

                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                        data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                        data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div id="modal-location">

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="preview_container">
                                    <h2 id="previewTitle" style="text-shadow: none"></h2>
                                    <div id="previewContent" class="preview_content"></div>
                                    <div class="preview_divide"></div>
                                    <div style="font-weight: bold;padding-top:20px;padding-bottom:20px" id="commentsRecord">
                                    </div>
                                    <div id="previewComment" class='preview_comment'>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay"></div>
    <div class="spanner show">
        <div class="loader"></div>
        <p>Loading...</p>
    </div>
    <script type="text/javascript">
        window.mobileAndTabletCheck = function() {
            let check = false;
            (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
        };
        var JSvar = "<?php echo esc_url( $url ); ?>";
        var allData = <?php echo json_encode($convertedArray); ?>;
        var pluginUrl = '<?php echo plugins_url(); ?>' ;
        var customerId = "<?php echo $atts['id']; ?>";
        var pageNo = 1;
        var pageSize = 25;
        var wall;

        setTimeout(() => {
            jQuery(document).ready(function() {
                wall = new Freewall("#freewall");
                wall.reset({
                    selector: '.brick',
                    animate: true,
                    cellW: 300,
                    cellH: 'auto',
                    onResize: function () {
                        wall.fitWidth();
                    }
                });

                wall.container.find('.brick img').load(function () {
                    wall.fitWidth();
                });
                jQuery('#freewall').css('opacity', '1');

                if(mobileAndTabletCheck())
                {
                    jQuery('#app-nav').css('opacity', '0.8');
                }
                jQuery("div.spanner").removeClass("show");
                wall.fitWidth()

            });
        }, 1500);

        function displayOverlay(id) {
            jQuery('#overlay-' + id).append(`<div class='overlay-content'>${allData[id].content}</div>`)
            jQuery('#overlay-' + id).show()
        };

        function hideOverlay(id) {
            jQuery('#overlay-' + id).empty()
            jQuery('#overlay-' + id).hide()
        };

        function showDetail(idx) {
            jQuery("#previewComment").empty()
            jQuery('#modal-location').empty()
            jQuery("#carousel-slider").empty()
            jQuery("#carousel-idx").empty()
            jQuery('#previewTitle').empty()
            jQuery('#commentsRecord').empty()
            jQuery('#previewTitle').text(allData[idx].title)
            jQuery("#previewContent").text(allData[idx].content);
            for (let i = 0; i <= allData[idx].imageUrls.length; i++) {
                let img = allData[idx].imageUrls[i]
                if (img) {
                    if (i === 0) {
                        jQuery("#carousel-idx").append(`<li data-target="#carouselExampleIndicators" data-slide-to="${i}" class="active"></li>`)
                        jQuery("#carousel-slider").append(`<div class='carousel-item active'><img class='d-block w-100' style="border-radius:10px" src="${img}"/></div>`)
                    } else {
                        jQuery("#carousel-idx").append(`<li data-target="#carouselExampleIndicators" data-slide-to="${i}"></li>`)
                        jQuery("#carousel-slider").append(`<div class='carousel-item'><img class='d-block w-100' style="border-radius:10px" src="${img}"/></div>`)
                    }
                }
            }
            jQuery('.carousel').carousel()
            let locArray = allData[idx].places
            let locs = [...new Set(locArray.map(item => item.name))]

            if (locs && locs.length > 0) {
                locs.map(lc => {
                    jQuery('#modal-location').append(`<span style="font-size:12px;font-weight:normal;border-radius: 11px;" class="badge badge-info"><img style='height:16px;padding-bottom:2px;' src='<?php echo plugins_url( '/assets/location-place-white.png', __FILE__ ); ?>'/>${lc}</span>&nbsp;&nbsp;`)
                })
            }
            console.log(allData[idx])
            jQuery.get(`https://api.nowy.io/posts/listComment?postId=${allData[idx].objectId}`).then(res => {
                if (res.length > 0) {
                    jQuery('#commentsRecord').append(`<div>There are ${res.length} comments</div>`)
                        for (let i = 0; i < res.length; i++) {
                            let re = res[i]
                            let avatarUrl = ''
                            if(re['user'].hasOwnProperty('avatarUrl')){
                                if(re['user']['avatarUrl']){
                                    avatarUrl = re['user']['avatarUrl']
                                }
                            }else{
                                if(re['user']['avatar']){
                                    avatarUrl = re['user']['avatar']['url']
                                }
                            }
                            if (avatarUrl) {
                                jQuery("#previewComment").append(`
                                    <div style="display: flex;">
                                        <img class="header-img" src="${avatarUrl}"/>&nbsp;&nbsp;
                                        <div style="font-size: 12px;">
                                            <div>
                                                ${re.user.displayName}
                                            </div>
                                            <div>
                                                ${re.content}
                                            </div>
                                        </div>
                                    </div>`);
                            } else {
                                jQuery("#previewComment").append(`
                                <div style="display: flex;">
                                    <img class="header-img" src="<?php echo plugins_url( '/assets/default-head.png', __FILE__ ); ?>"/>&nbsp;&nbsp;
                                <div style="font-size: 12px">
                                    <div>
                                        ${re.user.displayName}
                                    </div>
                                    <div>
                                        ${re.content}
                                    </div>
                                </div>`);
                            }
                        }
                }
            })
            jQuery('#exampleModal').modal()
            jQuery('#exampleModal').modal('handleUpdate')
        }

        function getParameterByName(name, url = window.location.href) {
            name = name.replace(/[\[\]]/g, '\\$&');
            var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }

        function loadMore(){
            jQuery('#loadMore').hide();
            jQuery('#loadMoreSpinner').show();
            pageNo = pageNo+1;
            jQuery.get(`https://api.nowy.io/posts/listPro?pageNo=${pageNo}&pageSize=${pageSize}&id=${customerId}`).then(res => {
                let moreRes = res
                let oldPostsLength = allData.length
                if(moreRes.length>0){
                    console.log(moreRes.length,'++++')
                    allData = allData.concat(moreRes)
                    for (let i = 0; i < moreRes.length; i++) {
                        const morePost = moreRes[i];
                        const moreIdx = oldPostsLength+i
                        jQuery('#freewall').append(
                            `<div class='brick post_container' onclick='showDetail(${moreIdx})'>
                        <div class='img-container'>
                            <img src='${morePost.thumbnailUrl?morePost.thumbnailUrl:morePost.imageUrls[0]}' class='brick-img' onmouseenter='displayOverlay(${moreIdx})'/>
                            <div class='img-overlay' id='overlay-${moreIdx}'  onmouseout='hideOverlay(${moreIdx})'>
                            </div>
                            <div class='location'><span><img src="<?php echo plugins_url( '/assets/place-marker-black.png', __FILE__ ); ?>"
                                                            style='width: 14px;padding-bottom: 3px;'/></span><span style='font-size:14px;'>${morePost.hasOwnProperty('places')?morePost.places.length>0?morePost.places[0].name:'':''}</span>
                            </div>
                        </div>
                        <div class='content'>${morePost.title}</div>
                        <div class='info user_container'>
                            <div>
                                <img src='${morePost.poster.hasOwnProperty('avatarUrl')?morePost.poster.avatarUrl:morePost.poster.avatar?morePost.poster.avatar.url:'<?php echo plugins_url( '/assets/default-head.png', __FILE__ ); ?>'}' class='header-img'/>
                            </div>
                            <div style='font-size:14px;padding-left:10px;padding-top:2px'>
                               ${morePost.hasOwnProperty('poster')?morePost.poster.displayName:''}
                            </div>
                            <div class='heart-container'>
                                <span style='padding:2px;'><img src="<?php echo plugins_url( '/assets/Heart2x.png', __FILE__ ); ?>"
                                                                style='width:25px;height:26px;padding-bottom:2px;'/><span
                                        style='font-size:14px;'>&nbsp;&nbsp;${morePost.hasOwnProperty('likeUsers')?morePost.likeUsers.length:0}&nbsp;&nbsp;</span></span>
                            </div>
                        </div>
                    </div>`
                        )
                    }
                    setTimeout(() => {
                        wall = new Freewall("#freewall");
                        wall.reset({
                            selector: '.brick',
                            animate: true,
                            cellW: 300,
                            cellH: 'auto',
                            onResize: function () {
                                wall.fitWidth();
                            }
                        });

                        wall.container.find('.brick img').load(function () {
                            wall.fitWidth();
                        });

                        jQuery(document).ready(function() {
                            wall.fitWidth()
                        });
                        jQuery('#loadMore').show();
                        jQuery('#loadMoreSpinner').hide();
                    }, 100);
                }else{
                    pageNo = pageNo -1;
                    jQuery('#loadMore').hide();
                    jQuery('#loadMoreSpinner').hide();
                    alert('No more data.')
                }
            })
        }
            
    </script>
    <footer>
        <div class='footer-container'>
            <button type='button' style="width:100%;" class='btn btn-outline-primary' id="loadMore" onclick="loadMore()">Load More</button>
            <button class="btn btn-primary" type="button" disabled style="display: none;width:100%;" id="loadMoreSpinner">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
            </button>
        </div>
        <p> <a href="https://nowy.io" target="_blank" rel="noopener noreferrer" class="footer-link">Powered by Nowy <img style="width:24px" src="<?php echo plugins_url( '/assets/novylogo-2-min.png', __FILE__ ); ?>"/></a></p>
    </footer>
</div>
