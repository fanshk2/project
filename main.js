var base_url;
var max_recent_task;
var max_menu_profile;

base_url = document.getElementById("v_base_url").value;
max_recent_task = document.getElementById("v_max_recent_task").value;
max_menu_profile = document.getElementById("v_max_menu_profile").value;

function createRequestObject() {
    var ro;
    var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer"){
        ro = new ActiveXObject("Microsoft.XMLHTTP");
    }else{
        ro = new XMLHttpRequest();
    }
    return ro;
}

var xmlhttp = createRequestObject();

function CallAjax(ajax_type, param1, param2, param3, param4, param5)
{
    try{
        var variabel;
        variabel = "";
        
        if(param1=='undefined') param1 = "";
        if(param2=='undefined') param2 = "";
        if(param3=='undefined') param3 = "";
        if(param4=='undefined') param4 = "";
        if(param5=='undefined') param5 = "";

        if(ajax_type=="open_menu")
        {
            variabel  = "&v_menu_id="+param1;
            //alert(variabel);
            document.getElementById("loading_ajax").innerHTML = '<img src="assets/img/wait.gif">';

            xmlhttp.open('get', base_url+'/engine.php?ajax_type='+ajax_type+variabel, true);
            xmlhttp.onreadystatechange = function() {
                if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
                {
                    arr_data = xmlhttp.responseText.split("@#@");
                    
                    //alert(xmlhttp.responseText);
                    
                    if(arr_data[2]=="Lock")
                    {
                        document.getElementById("loading_ajax").innerHTML = '';
                        document.getElementById("div_recent_task").style.display = 'none';
                        
                        document.getElementById("div_content_title").innerHTML = arr_data[2];
                        
                        for(i=1;i<=max_recent_task;i++)
                        {
                            document.getElementById("div_content_"+i).style.display = 'none';
                        }
                        
                        for(i=1;i<=max_menu_profile;i++)
                        {
                            document.getElementById("div_menu_profile_"+i).style.display = 'none';
                        }
                        
                        document.getElementById("div_content_lock").style.display = '';
                        document.getElementById("div_content_lock").innerHTML = arr_data[3];
                    }
                    else
                    {
                        document.getElementById("loading_ajax").innerHTML = '';
                        document.getElementById("div_recent_task").style.display = '';
                        
                        document.getElementById("div_recent_task").innerHTML = arr_data[1];
                        document.getElementById("div_content_title").innerHTML = arr_data[2];
                        
                        for(i=1;i<=max_recent_task;i++)
                        {
                            document.getElementById("div_content_"+i).style.display = 'none';
                        }
                        
                        document.getElementById("div_content_"+arr_data[0]).style.display = '';
                        
                        if(arr_data[4]=="RELOAD_NEW_PAGE")
                        {
                            document.getElementById("div_content_"+arr_data[0]).innerHTML = arr_data[3];    
                        }
                    }
                    
                    if(arr_data[5])
                    {
                        document.getElementById(arr_data[5]).focus();    
                    }
                    

                    return false;
                }

            }

            xmlhttp.send(null);
        }
        
        else if(ajax_type=="search_ajax")
        {
            var q;
            
            q = document.getElementById("q_"+param1).value;
            
            variabel   = "&v_modul="+param1;
            variabel  += "&q="+q;
            
            //alert(variabel);
            
            document.getElementById("loading_ajax").innerHTML = '<img src="assets/img/wait.gif">';

            xmlhttp.open('get', base_url+'/engine.php?ajax_type='+ajax_type+variabel, true);
            xmlhttp.onreadystatechange = function() {
                if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
                {
                    arr_data = xmlhttp.responseText.split("@#@");
                    
                    document.getElementById("td_body_"+param1).innerHTML = xmlhttp.responseText;
                    document.getElementById("loading_ajax").innerHTML = '';

                    return false;
                }

            }

            xmlhttp.send(null);   
        }
        
        else if(ajax_type=="add_ajax")
        {   
            variabel   = "&v_modul="+param1;
            
            //alert(variabel);
            
            document.getElementById("loading_ajax").innerHTML = '<img src="assets/img/wait.gif">';

            xmlhttp.open('get', base_url+'/engine.php?ajax_type='+ajax_type+variabel, true);
            xmlhttp.onreadystatechange = function() {
                if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
                {
                    arr_data = xmlhttp.responseText.split("@#@");
                    
                    document.getElementById("div_content_"+param1).innerHTML = xmlhttp.responseText;
                    document.getElementById("loading_ajax").innerHTML = '';

                    return false;
                }

            }

            xmlhttp.send(null);   
        }
        
        else if(ajax_type=="edit_ajax")
        {
            var q;
            
            q = document.getElementById("q_"+param1).value;
            
            variabel   = "&v_modul="+param1;
            variabel  += "&v_cid="+param2;
            
            //alert(variabel);
            
            document.getElementById("loading_ajax").innerHTML = '<img src="assets/img/wait.gif">';

            xmlhttp.open('get', base_url+'/engine.php?ajax_type='+ajax_type+variabel, true);
            xmlhttp.onreadystatechange = function() {
                if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
                {
                    arr_data = xmlhttp.responseText.split("@#@");
                    
                    document.getElementById("div_content_"+param1).innerHTML = xmlhttp.responseText;
                    document.getElementById("loading_ajax").innerHTML = '';

                    return false;
                }

            }

            xmlhttp.send(null);   
        }
        
        else if(ajax_type=="delete_ajax")
        {
            var q;
            
            q = document.getElementById("q_"+param1).value;
            
            variabel   = "&v_modul="+param1;
            variabel  += "&v_cid="+param2;
            
            //alert(variabel);
            
            document.getElementById("loading_ajax").innerHTML = '<img src="assets/img/wait.gif">';

            xmlhttp.open('get', base_url+'/engine.php?ajax_type='+ajax_type+variabel, true);
            xmlhttp.onreadystatechange = function() {
                if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
                {
                    arr_data = xmlhttp.responseText.split("@#@");
                    
                    document.getElementById("div_content_"+param1).innerHTML = xmlhttp.responseText;
                    document.getElementById("loading_ajax").innerHTML = '';

                    return false;
                }

            }

            xmlhttp.send(null);   
        }
        
        else if(ajax_type=="back_ajax")
        {
            var q;
            
            variabel   = "&v_modul="+param1;
            
            //alert(variabel);
            
            document.getElementById("loading_ajax").innerHTML = '<img src="assets/img/wait.gif">';

            xmlhttp.open('get', base_url+'/engine.php?ajax_type='+ajax_type+variabel, true);
            xmlhttp.onreadystatechange = function() {
                if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
                {
                    arr_data = xmlhttp.responseText.split("@#@");
                    
                    document.getElementById("div_content_"+param1).innerHTML = xmlhttp.responseText;
                    document.getElementById("loading_ajax").innerHTML = '';

                    return false;
                }

            }

            xmlhttp.send(null);   
        }
        


    }
    catch(err)
    {
        txt  = "There was an error on this page.\n\n";
        txt += "Error description AJAX : "+ err.message +"\n\n";
        txt += "Click OK to continue\n\n";
        alert(txt);
    }


}

function open_menu_profile()
{
    var i;
    for(i=1;i<=max_menu_profile;i++)
    {
        parent.document.getElementById("div_menu_profile_"+i).style.display = '';
        
    } 
}

function validasi_change_password(modul)
{
    if(document.getElementById('v_'+modul+'_password_old').value=='')
    {
        alert('Password Lama harus diisi');
        document.getElementById('v_'+modul+'_password_old').focus();
        return false;
    }
    else if(document.getElementById('v_'+modul+'_password_new').value=='')
    {
        alert('Password Baru harus diisi');
        document.getElementById('v_'+modul+'_password_old').focus();
        return false;
    }
    else if(document.getElementById('v_'+modul+'_cpass').value=='')
    {
        alert('Ulangi Password Baru harus diisi');
        document.getElementById('v_'+modul+'_cpass').focus();
        return false;
    }
    else if(document.getElementById('v_'+modul+'_cpass').value!=document.getElementById('v_'+modul+'_password_new').value)
    {
        alert('Password Baru harus sama dengan Ulangi Password Baru');
        document.getElementById('v_'+modul+'_cpass').focus();
        return false;
    }
}

function validasi_menu(modul)
{
    if(document.getElementById('v_'+modul+'_menu_name').value=='')
    {
        alert('Name harus diisi');
        document.getElementById('v_'+modul+'_menu_name').focus();
        return false;
    }    
    else if(document.getElementById('v_'+modul+'_menu_group').value=='')
    {
        alert('Group harus diisi');
        document.getElementById('v_'+modul+'_menu_group').focus();
        return false;
    }    
}

function validasi_lock(modul)
{
    if(document.getElementById('v_'+modul+'_password').value=='')
    {
        alert('Password harus diisi');
        document.getElementById('v_'+modul+'_password').focus();
        return false;
    }    
}


function validasi_size_attach(file, file_name) {
    var FileSize = file.files[0].size / 1024 / 1024; // in MB
    if (FileSize > 2) {
        alert('Maksimum ukuran file adalah 1 Mb');
        //$(file).val(''); //for clearing with Jquery
        document.getElementById(file_name).value = '';
    } else {

    }
}

function change_page(nilai)
{
    //window.location = nilai;
    window.location = nilai;
}

function get_url(url)
{
    //window.location = url;
    //setTimeout(function(){document.location.href = url},500);
    //window.open(url);
    window.location.assign(url);
}

function change_search(url, q, p)
{
    q = document.getElementById('q').value;
    
    url_send = url+'/search/'+q+'/'+p;
    get_url(url_send);
}

function confirm_logout()
{
    var r = confirm("Apakah anda yakin Logout ?");
    if(r){
        window.location = base_url+'/logout.php';
    }
}

function show_hide_menu()
{
    var v_menu_hidden = document.getElementById('v_menu_hidden').value;   
    
    if(v_menu_hidden*1==0)
    {
        document.getElementById("div_body").classList.remove('layout-has-drawer');
        document.getElementById('v_menu_hidden').value = '1';   
    }
    else if(v_menu_hidden*1==1)
    {
        document.getElementById("div_body").classList.add('layout-has-drawer');
        document.getElementById('v_menu_hidden').value = '0';   
    }
}

