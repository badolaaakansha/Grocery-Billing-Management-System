function remove(bid){
    
    xobj=new XMLHttpRequest();
    xobj.onreadystatechange = function(){
        if(xobj.readystate == 4 && xobj.status == 200){
            //search();
            document.getElementById("display_here").innerHTML =xobj.responseText;
        } 
        
    }
    xobj.open("GET", "deltemp.php?id="+bid, true);
    xobj.send();
}





function searchdata(){
        xobj=new XMLHttpRequest();
        xobj.onreadystatechange = function(){
            //if(xobj.readystate == 4 && xobj.status == 200){
              try {
                  var dt = JSON.parse(xobj.responseText);
                  // Process the parsed JSON data
              } catch (error) {
                  console.error("Error parsing JSON:", error);
                  // Handle the error gracefully, e.g., display a message to the user
              }
              
                str = '';
                str = str + "<div class='container2'>";
                str = str + "<table border='2' class='totalrecords'>";
  
            for(i=0; i<dt.totalRecord.length; i++){                    
                str = str + "<tr>";
                str = str + "<td>";
                str = str +dt.totalRecord[i]['name'];  
                str = str + "</td>";
                str = str + "<td>";
                str = str + "<span style='color:green'></span>"+ dt.totalRecord[i]['mrp'] +  "<br>";
                str = str + "</td>";
                str = str + "<td>";
                str = str + "<span style='color:red'></span>" +dt.totalRecord[i]['Qnt']+ "<br>";
                str = str + "</td>";
                str = str + "<td>";
                str = str + "<span style='color:green'></span>"+ dt.totalRecord[i]['mrp']*dt.totalRecord[i]['Qnt'] +  "<br>";
                str = str + "</td>";
                str = str + "<td>";
                str = str + "<div style='cursor: pointer' onclick='remove("+dt.totalRecord[i]['id']+");'>"+'Remove'+"</div>"  
               
                // str = str + "<a href='Remove.php?id="+dt.totalRecord[i]['id']+"' onclick=add()>"+'Remove'+"</a>"  
                str = str + "</td>";
                str = str + "</tr>";
                
            }
            str = str + "</table>";
            str = str + "</div>";
            document.getElementById("display_here").innerHTML =str;
        }
        xobj.open("GET", "fetchdata.php", true);
        xobj.send();
    
  }



//dt.totalRecord[i]['name']; 
function search(){
  let name= document.getElementById('pname').value;
  let Qnt= document.getElementById('qnt').value;
  if(Qnt==''){
    alert("Enter Quantity")
    
  }
  else{
      xobj=new XMLHttpRequest();
      xobj.onreadystatechange = function(){
          //if(xobj.readystate == 4 && xobj.status == 200){
            try {
                var dt = JSON.parse(xobj.responseText);
                // Process the parsed JSON data
            } catch (error) {
                console.error("Error parsing JSON:", error);
                // Handle the error gracefully, e.g., display a message to the user
            }
            
              document.getElementById("message").innerHTML = dt.message;  
              str = '';
              str = str + "<div class='container2'>";
              str = str + "<table border='2' class='totalrecords'>";

          for(i=0; i<dt.totalRecord.length; i++){                    
              str = str + "<tr>";
              str = str + "<td>";
              str = str +dt.totalRecord[i]['name'];  
              str = str + "</td>";
              str = str + "<td>";
              str = str + "<span style='color:green'></span>"+ dt.totalRecord[i]['mrp'] +  "<br>";
              str = str + "</td>";
              str = str + "<td>";
              str = str + "<span style='color:red'></span>" +dt.totalRecord[i]['Qnt']+ "<br>";
              str = str + "</td>";
              str = str + "<td>";
              str = str + "<span style='color:green'></span>"+ dt.totalRecord[i]['mrp']*dt.totalRecord[i]['Qnt'] +  "<br>";
              str = str + "</td>";
              str = str + "<td>";
              str = str + "<div style='cursor: pointer' onclick='remove("+dt.totalRecord[i]['id']+");'>"+'Remove'+"</div>"  
             
              // str = str + "<a href='Remove.php?id="+dt.totalRecord[i]['id']+"' onclick=add()>"+'Remove'+"</a>"  
              str = str + "</td>";
              str = str + "</tr>";
              
          }
          str = str + "</table>";
          str = str + "</div>";
          document.getElementById("display_here").innerHTML =str;
      }
      xobj.open("GET", "fetchitem.php?name="+name+"&Qnt="+Qnt, true);
      xobj.send();
  }
}
