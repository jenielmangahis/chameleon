(function(){
    //Section 1 : Code to execute when the toolbar button is pressed
   var a= {
        exec:function(editor){
           
            var media = window.showModalDialog(editor.config.diglogpath + "/html/index.html",null,"dialogWidth:550px;dialogHeight:200px;center:yes; resizable: yes; help: no");  
             // editor.insertHtml('<a href="http://media.photobucket.com/image/fireworks/novaheart/2008 pics canon s5is/villageamphitheatrefireworks.jpg?o=14" target="_blank"><img src="http://i47.photobucket.com/albums/f180/novaheart/2008%20pics%20canon%20s5is/villageamphitheatrefireworks.jpg" border="0"></a>');
             
//            /alert(media);            
            editor.insertHtml('<img src="'+media+'" border=0>');
             
             /*if(media != false && media != null)  
             {  
                 if(media.mediaUrl.substr(media.mediaUrl.length-4) == ".wmv")  
                     editor.insertHtml("<img src='" + media.mediaUrl + "' />");  
                 else  
                     editor.insertHtml("<img src='" + media.mediaUrl + "' />");  
             }  */
           
        }
    },
       //Section 2 : Create the button and add the functionality to it
    b='photobucket';
    CKEDITOR.plugins.add(b,{
        init:function(editor){
            editor.addCommand(b,a);
            editor.config.diglogpath = this.path;
            editor.ui.addButton('photobucket',{
                label:'Photo Bucket/Flickr',
                icon: this.path + 'photobucket.gif',
                command:b
            });
        }
    });
    
})();
CKEDITOR.config.diglogpath = ""; 