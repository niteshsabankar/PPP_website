var openFile = function(event) {
  var input = event.target;
  var reader = new FileReader();
  reader.onload = function(){
    var text = reader.result;
    var index = text.indexOf('CHROM');
    var tempString = text.substring(0, index);
    var lineNumber = tempString.split('\n').length;
    indivNameLine = text.split('\n')[lineNumber-1];
    indivNames = indivNameLine.split("FORMAT\t")[1];
    individual = indivNames.split("\t");

    for (i = 0; i < individual.length; i++) { 
      var x = document.createElement("LI");
      var t = document.createTextNode(individual[i]);
      x.appendChild(t);
      document.getElementById("list1").appendChild(x).classList.add("sortable-item");;
    }
  };
  reader.readAsText(input.files[0]);
};

function population(){
  var userInput = document.getElementById("userInput").value;
  var x = document.createElement("LI");
  var t = document.createTextNode(userInput);
  x.appendChild(t);
  document.getElementById("list2").appendChild(x).classList.add("sortable-item");
  }