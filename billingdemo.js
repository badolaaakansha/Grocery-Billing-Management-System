function remove(bid,sid) {
    var xobj = new XMLHttpRequest();
    xobj.onreadystatechange = function () {
        if (xobj.readyState === 4 && xobj.status === 200) {
            // Handle response
            searchdata(sid);
        }
    };
    xobj.open("GET", "deltemp.php?id=" + bid, true);
    xobj.send();
}

function searchdata(sid) {
    var xobj = new XMLHttpRequest();
    xobj.onreadystatechange = function () {
        if (xobj.readyState === 4 && xobj.status === 200) {
            try {
                var dt = JSON.parse(xobj.responseText);
                var str = '';
                str += "<div class='container2'>";
                str += "<table  class='totalrecords'>";

                for (var i = 0; i < dt.totalRecord.length; i++) {
                    str =str+ "<tr style='height:30px'>";
                    str =str+ "<td style='width:349px'>" + dt.totalRecord[i]['name'] + "</td>";
                    str =str+ "<td style='width:130px'><span style='color:green'></span>" + dt.totalRecord[i]['mrp'] + "<br></td>";
                    str =str+ "<td  style='width:94px'><span style='color:red'></span>" + dt.totalRecord[i]['Qnt'] + "<br></td>";
                    str =str+ "<td style='width:259px'><span style='color:green'></span>" + dt.totalRecord[i]['mrp'] * dt.totalRecord[i]['Qnt'] + "<br></td>";
                    str =str+ "<td><div style='cursor: pointer; text-align:center' onclick='remove(" + dt.totalRecord[i]['id'] +','+ sid +");'><i class='fa-solid fa-trash'></i></div></td>";
                    str =str+ "</tr>";
                }
                str += "</table>";
                str += "</div>";
                document.getElementById("display_here").innerHTML = str;
            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        }
    };
    xobj.open("GET", "fetchdata.php?sid=" + sid, true);
    xobj.send();
}








function search(sid) {
    var name = document.getElementById('pname').value;
    var Qnt = document.getElementById('qnt').value;

    if (Qnt == '') {
        alert("Enter Quantity");
    } else {
        var xobj = new XMLHttpRequest();
        xobj.onreadystatechange = function () {
            if (xobj.readyState == 4 && xobj.status == 200) {
                try {
                    var dt = JSON.parse(xobj.responseText);
                    document.getElementById("message").innerHTML = dt.message;
                    var str = '';
                    str += "<div class='container2'>";
                    str += "<table  class='totalrecords'>";

                    for (var i = 0; i < dt.totalRecord.length; i++) {
                        str =str+ "<tr style='height:30px'>";
                        str =str+ "<td style='width:349px'; >" + dt.totalRecord[i]['name'] + "</td>";
                        str =str+ "<td style='width:130px'><span style='color:green'></span>" + dt.totalRecord[i]['mrp'] + "<br></td>";
                        str =str+ "<td  style='width:94px'><span style='color:red'></span>" + dt.totalRecord[i]['Qnt'] + "<br></td>";
                        str =str+ "<td style='width:259px'><span style='color:green'></span>" + dt.totalRecord[i]['mrp'] * dt.totalRecord[i]['Qnt'] + "<br></td>";
                        str =str+ "<td><div style='cursor: pointer; align-item:center;' onclick='remove(" + dt.totalRecord[i]['id']+ ',' + sid +");'><i class='fa-solid fa-trash'></i></div></td>";
                        str =str+ "</tr>";
                    }
                    str += "</table>";
                    str += "</div>";
                    document.getElementById("display_here").innerHTML = str;
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                    
                }
            }
        };
        xobj.open("GET", "fetchitem.php?name=" + name + "&Qnt=" + Qnt + "&store_id=" + sid   , true);
        xobj.send();
    }
}
