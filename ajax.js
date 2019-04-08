/*
    IT WAS TOO LATE THE MOMENT I REALIZED I CAN"T #INCLUDE THINGS INTO THINGS LIKE IN C AND PHP
    NOW WHAT REMAINS IS AN ABOMINATION OF A JS FILE
*/

/*
function request_example() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.getElementById("txtHint").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "apphandler.php?action=" + str, true);
    xmlhttp.send();
}*/

// Sends an AJAX request to the web server to send the starting values
function submit_initial_data() {
    var cs   = document.getElementById("cs").value;
    var pv   = document.getElementById("pv").value;
    var nv   = document.getElementById("nv").value;
    var itct = document.getElementById("itct").value;
    var ir   = document.getElementById("ir").value;
    var l    = document.getElementById("l").value;
    var g    = document.getElementById("g").value;
    var fm   = document.getElementById("fm").value;


    console.log("Valoarea lui Cs: "     + cs);
    console.log("Valoarea lui Pv: "     + pv);
    console.log("Valoarea lui Nv: "     + nv);
    console.log("Valoarea lui Itct: "   + itct);
    console.log("Valoarea lui Ir: "     + ir);
    console.log("Valoarea lui l: "      + l);
    console.log("Valoarea lui g: "      + g);
    console.log("Valoarea lui fm: "     + fm);

    var form = document.getElementById("initial_form");
    form.parentNode.removeChild(form);

    var button = document.getElementById("initial_data_button");
    button.parentNode.removeChild(button);

    // submit data
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            print(this.responseText);
            prompt_A();
        }
    };
    xmlhttp.open("POST", "webapp.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var requestString = "action=submit_initial_data&cs="+cs+"&pv="+pv+"&nv="+nv+"&itct="+itct+"&ir="+ir+"&l="+l+"&g="+g+"&fm="+fm;
    xmlhttp.send(requestString);
    console.log("Sent request: " + requestString);
}



function debug(str) {
    console.log(str);
}
function print(str) {
    document.getElementById("data").innerHTML += str + "<br>";
}
//    var requestString = "action=get_prompt_a&value=";


function print_all_data() {
    // submit data
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            print(this.responseText);
        }
    };
    xmlhttp.open("POST", "webapp.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var requestString = "action=print_all_data";
    xmlhttp.send(requestString);
    console.log("Sent request: " + requestString);
}
















/* 
    I can refactor this into something nice, but i'm lazy
*/



function prompt_A() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // we received message for A, now show the button etc
            print(this.responseText);
            // first time toggling on the input 
            toggle_input();
            set_input_text(this.responseText);
            set_button_onclick(()=> {
                set_A();
            });    
        }
    };
    var requestString = "action=get_prompt_a";

    xmlhttp.open("POST", "webapp.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(requestString);
    debug("Sent request: " + requestString);
}

function set_A() {
    var input = get_input_box_text();
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            print(this.responseText);

            if(this.responseText == "INVALID_NUMBER") {
                return;
            }
            prompt_C();
        }
    };
    var requestString = "action=set_a&value=" + input;

    xmlhttp.open("POST", "webapp.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(requestString);
    debug("Sent request: " + requestString);
}






function prompt_C() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            print(this.responseText);

            set_input_text(this.responseText);
            set_button_onclick(()=> {
                set_C();
            });    
        }
    };
    var requestString = "action=get_prompt_c";

    xmlhttp.open("POST", "webapp.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(requestString);
    debug("Sent request: " + requestString);
}
function set_C() {
    var input = get_input_box_text();
    var xmlhttp = new XMLHttpRequest();


    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            print(this.responseText);

            if(this.responseText == "INVALID_NUMBER") {
                return;
            }
            prompt_DP1();
        }
    };
    var requestString = "action=set_c&value=" + input;

    xmlhttp.open("POST", "webapp.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(requestString);
    debug("Sent request: " + requestString);
}







function prompt_DP1() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            print(this.responseText);

            set_input_text(this.responseText);
            set_button_onclick(()=> {
                set_DP1();
            });    
        }
    };
    var requestString = "action=get_prompt_dp1";

    xmlhttp.open("POST", "webapp.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(requestString);
    debug("Sent request: " + requestString);
}
function set_DP1() {
    var input = get_input_box_text();
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            print(this.responseText);

            if(this.responseText == "INVALID_NUMBER") {
                return;
            }
            prompt_APREL();
        }
    };
    var requestString = "action=set_dp1&value=" + input;

    xmlhttp.open("POST", "webapp.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(requestString);
    debug("Sent request: " + requestString);
}







function prompt_APREL() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            print(this.responseText);

            set_input_text(this.responseText);
            set_button_onclick(()=> {
                set_APREL();
            });    
        }
    };
    var requestString = "action=get_prompt_aprel";

    xmlhttp.open("POST", "webapp.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(requestString);
    debug("Sent request: " + requestString);
}
function set_APREL() {
    var input = get_input_box_text();
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            print(this.responseText);

            if(this.responseText == "INVALID_NUMBER") {
                return;
            }
            prompt_Q();
        }
    };
    var requestString = "action=set_aprel&value=" + input;

    xmlhttp.open("POST", "webapp.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(requestString);
    debug("Sent request: " + requestString);
}







function prompt_Q() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // we received message for A, now show the button etc
            print(this.responseText);

            set_input_text(this.responseText);
            set_button_onclick(()=> {
                set_Q();
            });    
        }
    };
    var requestString = "action=get_prompt_q";

    xmlhttp.open("POST", "webapp.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(requestString);
    debug("Sent request: " + requestString);
}
function set_Q() {
    var input = get_input_box_text();
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            print(this.responseText);

            if(this.responseText == "INVALID_NUMBER") {
                return;
            }
            debug("Not implemented");
        }
    };
    var requestString = "action=set_q&value=" + input;

    xmlhttp.open("POST", "webapp.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(requestString);
    debug("Sent request: " + requestString);
}

























































function get_input_box_text() {
    var val = document.getElementById("input_box").value;
    set_input_box_text('');
    return val;
}
function set_input_box_text(txt) {
    document.getElementById("input_box").value = txt;
}
function set_input_text(text) {
    document.getElementById("input_text").innerHTML = text;
}
function set_button_onclick(func) {
    document.getElementById("input_button").onclick = func;
}

function toggle_input() {
  var x = document.getElementById("input_block");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
} 


// Sessions store a pointer to a data location
function destroy_session() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           debug(this.responseText);
        }
    };
    xmlhttp.open("POST", "/webapp.php", true);
    var requestString = "destroy_session=true";
    xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send(requestString);
}