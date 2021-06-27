
 window.onload = ()=>{
    var data = ["assets/js/jquery-1.12.4.min.js",
 "assets/js/popper.min.js",
 "assets/bootstrap/js/bootstrap.min.js",
 "assets/owlcarousel/js/owl.carousel.min.js", 
 "assets/js/magnific-popup.min.js", 
 "assets/js/waypoints.min.js", 
 "assets/js/parallax.js", 
 "assets/js/jquery.countdown.min.js", 
 "assets/js/imagesloaded.pkgd.min.js",
 "assets/js/isotope.min.js",
 "assets/js/jquery.dd.min.js",
 "assets/js/slick.min.js",
 "assets/js/jquery.elevatezoom.js",
 "assets/js/scripts.js"]
function requireOnce(data) {  
    for (let index = 0; index < data.length; index++) {
        const url = data[index];     
        if (!$("script[src='" + url + "']").length) {
            var script = document.createElement('script');
            script.type = 'text/javascript';

            script.src = url;
            console.log(script)
            document.body.append(script);
        }
    }
     
    
}
requireOnce(data);
 }
 