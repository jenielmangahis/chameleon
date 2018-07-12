
/**
* Fucntion to set iframe height Dynamic 
*/
  function getiFrameElement(aID)              
    {        
        return (document.getElementById) ? document.getElementById(aID) :  document.all[aID];
    }

    function getIFrameDocument(aID){ 
        var rv = null; 
        var frame=getiFrameElement(aID);
        // if contentDocument exists, W3C          // compliant (e.g. Mozilla) 
        if (frame.contentDocument)
            rv = frame.contentDocument;
        else // bad Internet Explorer  ;)
            rv = document.frames[aID].document;
        return rv;
    }

    function adjustMyFrameHeight(eleId)
    {              
	   var frame = getiFrameElement(eleId);
        var frameDoc = getIFrameDocument(eleId);
        frame.height = frameDoc.body.offsetHeight;
    }




        
          