<?php
/*
 * Template for displaying arhive.
 */
?>
<?php get_header() ?>
<!--map-->
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
  
        ymaps.ready(function () {
        var myMap = new ymaps.Map('map', {
            center: [55.751574, 37.573856],
            zoom: 9,

        }, {
            searchControlProvider: 'yandex#search'
        }),
            clusterer = new ymaps.Clusterer({
            preset: 'islands#invertedDarkOrangeClusterIcons',
            groupByCoordinates: false,
            clusterDisableClickZoom: true,
            clusterHideIconOnBalloonOpen: false,
            geoObjectHideIconOnBalloonOpen: false
        }),
        geoObjects = [];
        var i = 0;
        <?php global $query_string; // параметры базового запроса
        query_posts($query_string.'&cat=-6,-9&order=ASC&posts_per_page=-1'); // базовый запрос + свои параметры
        ?>
        <?php if (have_posts()) : ?>
            <?php while (have_posts() ) : the_post(); ?>
                <?php 
                $latitude = get_field("latitude1");
                $longitude = get_field("longitude1");
                if(!empty($latitude)&!empty($longitude)){ ?>
                    var title = '<?php the_title(); ?>';
                    var lat =  '<?php echo $latitude; ?>'
                    var lon =  '<?php echo $longitude; ?>'	
                    geoObjects[i] = new ymaps.Placemark([lat,lon], { 
                        iconCaption: title,
                        hintContent: title,
                        balloonContent: '<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br><img src="<?php echo get_the_post_thumbnail_url (); ?>" style="width:auto; height:150px;">',
                        clusterCaption: title}
                    ,{preset: 'islands#darkOrangeIcon'});
                i++;
                <?php }; ?>
            <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_query();// сброс запроса?>
            clusterer.add(geoObjects);
            myMap.geoObjects.add(clusterer);
            myMap.setBounds(clusterer.getBounds(), {
                checkZoomRange: true
            });
        });
}
</script>
<!--end map-->
<div class="main-area-single">
        <div class="content content-single">
            <div class="archive archive-head">
                <h1><?php printf( single_cat_title('', false)); ?></h1>
            </div>
            <section class="grid">
                <?php
                // проверяем есть ли посты в глобальном запросе - переменная $wp_query
                if( have_posts() ){
                    // перебираем все имеющиеся посты и выводим их
                    while( have_posts() ){
                        the_post();
                        ?>
                        <div class="demo-card-wide mdl-card mdl-shadow--2dp" id="post-<?php the_ID(); ?>">
                        <?php $image_big = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large', false);
                        list($src_big, $width_big, $height_big) = $image_big; ?>
                            <div class="card-image-container">
                            <div class="mdl-card__img"  style="<?php if($image_big) { echo "background-image:url('". $src_big ."');";} ?>" onclick="location.href='<?php the_permalink();?>'">
                            </div>
                            </div>
                            <div class="card-content-section">
                                <h2 class="mdl-card__title-text"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <div class="mdl-card__supporting-text">
                                <?php the_excerpt(); ?>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
                                </div>
                                <div class="mdl-card__menu">
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
            </section>
            <div class="pagination-conatier">
                <div class="pagination">
                <?php echo paginate_links(
                    array(
                        'prev_text' => '&larr; Предыдущая страница',
                        'next_text' => 'Следующая страница &rarr;',
                    )
                ); ?>
                </div>
            </div>
             <?php
            }
            // постов нет
            else {
                echo "<h2>Записей нет.</h2>";
            }
            ?>

    </div>
</div>
<?php get_footer() ?>