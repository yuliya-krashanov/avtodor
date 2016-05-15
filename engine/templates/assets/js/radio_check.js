var checked_support = Modernizr.addTest('checkedselector',function(){
  return selectorSupported(':checked');
});

if( !checked_support.checkedselector ){
  var inputs = document.getElementsByTagName('input');
  for( var i=0; i < inputs.length; i++ ){
    inputs[i].onclick = function input_checked(){
      if( this.type == 'radio' ){
        var group_inputs = document.getElementsByName( this.name );
        for( var i=0; i < group_inputs.length; i++ ){
          group_inputs[i].parentNode.className = 'input-blue radio';
        }
      }
      if ( this.checked ){
        this.parentNode.className = 'input-blue ' + this.type +' checked';
      } else {
        this.parentNode.className = 'input-blue  ' + this.type;
      }
    }
  }
}