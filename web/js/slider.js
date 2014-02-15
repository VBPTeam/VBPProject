function Slider (opt) {
    right = opt.right;
	left = opt.left;
	slider = opt.slider;
	
	slider.style.left = '0px';
	
	left.addEventListener('click', function () {
        if(slider.style.left === '-1080px') return false;
	    slider.style.left = parseInt(slider.style.left) - 180 + 'px';
    },false);
	
    right.addEventListener('click', function () {
        if(slider.style.left == '0px') return false;
        slider.style.left = parseInt(slider.style.left) + 180 + 'px';
    },false);
}