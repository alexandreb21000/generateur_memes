var loadFile = function(event) {
  var output = document.getElementById('output');
  var submitMeme = document.getElementById('generatememe');

  output.src = URL.createObjectURL(event.target.files[0]);
  
  submitMeme.addEventListener('click', function(){

    output.style.display = "none";
  });
};



  UIkit.offcanvas(element, options);
  UIkit.offcanvas(element).show();
  UIkit.offcanvas(element).hide();


