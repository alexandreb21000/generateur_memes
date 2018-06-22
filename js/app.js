var loadFile = function(event) {
  var output = document.getElementById('output');
  output.src = URL.createObjectURL(event.target.files[0]);
};

  UIkit.offcanvas(element, options);
  UIkit.offcanvas(element).show();
  UIkit.offcanvas(element).hide();


