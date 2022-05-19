<?php
/*
 * Template for displaying single posts.
 */
?>
<?php get_header() ?>
<!--map-->




<?php
$latitude = get_field("latitude1");
$longitude = get_field("longitude1");
if(!empty($latitude)&!empty($longitude)){
    $zoom = get_field("zoom1");
    ?>

    <div id="map" class="map"></div>
    <input type="button" id= "mapButton" class="map-button" value="Открыть карту" onclick="startMap()">  
    <script>
if( window.innerWidth >= 600 ){
    startMap();
}
function startMap(){  
    let mapContainer = document.getElementById("map");
    let mapButton = document.getElementById("mapButton");
    if(!mapContainer.classList.contains('generated')){
        var elem = document.createElement('script');
        elem.type = 'text/javascript';
        elem.src = '//api-maps.yandex.ru/2.1/?load=package.standard&lang=ru-RU&onload=getYaMap';
        document.getElementsByTagName('body')[0].appendChild(elem);
        mapButton.value = "Закрыть карту";
        mapContainer.classList.add("generated","map-show")
    }else{
        if(mapContainer.classList.contains('map-show')){
            mapButton.value = "Открыть карту";
            mapContainer.classList.remove("map-show")
        }else{
            mapButton.value = "Закрыть карту";
            mapContainer.classList.add("map-show")
        }
    }
}
function getYaMap() {
    ymaps.ready(init);
        var myMap,
            myPlacemark;
        function init(){    
            var latitude =  '<?php echo $latitude; ?>'
            var longitude =  '<?php echo $longitude; ?>'
            var title =  '<?php echo the_title(); ?>'
            var zoom =  '<?php echo $zoom; ?>'
                myMap = new ymaps.Map("map", {
                    center: [latitude,longitude],
                    zoom: zoom
                });

                myPlacemark = new ymaps.Placemark( [latitude, longitude], { 
                    hintContent: title, 
                    balloonContent: '<a href="geo:0,0?q='+latitude+','+longitude+' ('+title+')">Открыть в картах</a>',
                    iconCaption: 'Открыть в картах'
            });

            myMap.geoObjects.add(myPlacemark);
        }
}
    </script>
<?
}
?>
<!-- end map -->
<div class="main-area">
    <div class="content">
        <?php if( have_posts() ) : while( have_posts() ): the_post() ?>
            <div id="post-<?php the_ID() ?>" <?php post_class('inner-post-section') ?>>
                <div class="post-title">
                    <h1 class="page-title"><?php the_title() ?></h1>
                </div>
                <div class="post-content">
                    <?php the_content() ?>
                    
                    <?php
                    $videoId=get_field("id_video");
                                if(!empty($videoId)){
                                    
                                    ?><h2 class="inner-page">Видео</h2><?php
                                    echo '<div class="youtube" id="',$videoId, '" style="width: 100%; height: 360px;"></div>';
                                    $html =<<<HERE
                                    <script>
                                        "use strict";function r(t){/in/.test(document.readyState)?setTimeout("r("+t+")",9):t()}r(function(){if(document.getElementsByClassName)t=document.getElementsByClassName("youtube");else var t=function(t,e){for(var a=[],s=new RegExp("(^| )youtube( |$)"),i=t.getElementsByTagName("*"),r=0,u=i.length;r<u;r++)s.test(i[r].className)&&a.push(i[r]);return a}(document.body);for(var e=t.length,a=0;a<e;a++){t[a].style.backgroundImage="url(http://i.ytimg.com/vi/"+t[a].id+"/sddefault.jpg)";var s=document.createElement("div");s.setAttribute("class","play"),t[a].appendChild(s),t[a].onclick=function(){ym(44485084,"reachGoal","video");var t=document.createElement("iframe"),e="https://www.youtube.com/embed/"+this.id+"?autoplay=1&autohide=1";this.getAttribute("data-params")&&(e+="&"+this.getAttribute("data-params")),t.setAttribute("src",e),t.setAttribute("frameborder","0"),t.style.width=this.style.width,t.style.height=this.style.height,this.parentNode.replaceChild(t,this)}}});
                                    </script>
                                    HERE;
                                    echo $html;
                                }
                            ?>
                    
                    <?php wp_link_pages(array('before' => '<div class="post-nav-link"><span>' . __('Pages:', 'actuate') . '</span>', 'after' => '</div>')) ?>
                </div>

                <div class="post-below-content">
                    <p class="tags-below-content"><?php the_tags( __( 'Теги: ', 'actuate' ) , ', ', '') ?></p>
                </div>
                <div class="post-navigation">   
                    <?php the_post_navigation( array(
                    'next_text' =>'<span class="screen-reader-text">Следующая запись</span> ' .
                    '<span class="post-title">%title</span>'.
                    '<span class="meta-nav" aria-hidden="true">→</span> ',
                    'prev_text' => '<span class="meta-nav" aria-hidden="true">←</span> ' .
                    '<span class="screen-reader-text">Предыдущая запись</span> ' .
                    '<span class="post-title">%title</span>',
                    ) ); ?>
                </div>
             <?php comments_template( '', true ) ?>
            </div><!-- inner-content-section ends -->
        </div>

    <?php get_sidebar() ?>
</div><!-- Content-section ends here -->
<?php endwhile ?>
<?php endif ?>
<?php get_footer() ?>