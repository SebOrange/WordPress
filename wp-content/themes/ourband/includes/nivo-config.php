<script>
$(window).load(function() {
$('#slider').nivoSlider({
        effect: '<?php echo $options['slider_effects']; ?>',
        slices: 15, 
        boxCols: 8, 
        boxRows: 4, 
        animSpeed: <?php echo $options['slider_speed']; ?>,
        pauseTime: <?php echo $options['slider_pause']; ?>,
        startSlide: 0, 
        directionNav: true,
        controlNav: false, 
        controlNavThumbs: false, 
        pauseOnHover: true, 
        manualAdvance: false, 
        prevText: '', 
        nextText: '', 
        randomStart: false, 
        beforeChange: function(){}, 
        afterChange: function(){}, 
        slideshowEnd: function(){}, 
        lastSlide: function(){}, 
        afterLoad: function(){} 
    });
$('#my-nivo-slider').nivoSlider({
        slices: 15, 
        boxCols: 8, 
        boxRows: 4, 
        startSlide: 0, 
        directionNav: true,
        controlNav: false, 
        controlNavThumbs: false, 
        pauseOnHover: true, 
        manualAdvance: false, 
        prevText: '', 
        nextText: '', 
        randomStart: false, 
        beforeChange: function(){}, 
        afterChange: function(){}, 
        slideshowEnd: function(){}, 
        lastSlide: function(){}, 
        afterLoad: function(){} 
    });
});    
</script>
 