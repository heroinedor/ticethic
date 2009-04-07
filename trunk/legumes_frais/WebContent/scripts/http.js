/* ---------------------------------------------------
 Fichier: http.js
 --------------------------------------------------- */
/**
 * @fileoverview  Fichier http.js contenant la classe HTTP permettant de manipuler
 * l'objet XMLHTTPRequest  et les traitement en rapport.
 * Modified from the book JavaScript: The Definitive Guide, 5th Edition,
 * by David Flanagan. Copyright 2006 O'Reilly Media, Inc. (ISBN: 0596101996)
 *
 * @author Erwan Dorso cgen@airbus.com
 * @version CGEN 2.0 
 */
 
/** Nombre maximum de fois ou la requete XHR sera renvoyee en cas d'erreur*/
var XHR_MAX_RESEND_TIMES = 6;
/** Code d'erreur de la requete XHR quand elle a ete renvoye 
 * plusieurs fois en echec*/
var XHR_RESEND_ERRORSTATUS = 999;
/** Nombre de fois que la requete XHR a ete envoye*/
var XHR_RESEND_TIMES = 0;
/** Temps (en msec) au bout duquel la requete XHR sera annulee si pas de reponse*/
var XHR_TIMEOUT = 180000;

/** Methode d'envoi de la requete */
var XHR_GET = "GET";
var XHR_POST = "POST";

/** This is a list of XMLHttpRequest creation factory functions to try*/
XHRfactories = [
    function() { return new XMLHttpRequest(); },
    function() { return new ActiveXObject("Msxml2.XMLHTTP"); },
    function() { return new ActiveXObject("Microsoft.XMLHTTP"); }
];

/** When we find a factory that works, store it here*/
XHRfactory = null;

/**
 * Cree un nouvel objet XMLHttpRequest
 * Au premier appel, essaie toutes les fonction factory jusqu'a trouver 
 * celle qui renverra une valeur non nulle et qui ne renverra pas d'erreur.
 * Une fois trouvee, cette fonction est conservee pour un usage ulterieur.
 * @author David Flanagan
 * @return {Object} nouvel objet XMLHttpRequest
 */
function XHRnewRequest() {
    if (XHRfactory !== null) {
    	return XHRfactory();
    	}

    for(var i = 0; i < XHRfactories.length; i++) {
        try {
            var factory = XHRfactories[i];
            var request = factory();
            if (request !== null) {
                XHRfactory = factory;
                return request;
            }
        }
        catch(e) {
            continue;
        }
    }

    // If we get here, none of the factory candidates succeeded,
    // so throw an exception now and for all future calls.
    XHRfactory = function() {
        throw new Error("XMLHttpRequest not supported");
    };
    XHRfactory(); // Throw an error
}

/**
 * Send an HTTP POST request to the specified URL, using the names and values
 * of the properties of the values object as the body of the request.
 * Parse the server's response according to its content type and pass
 * the resulting value to the callback function.  If an HTTP error occurs,
 * call the specified errorHandler function, or pass null to the callback
 * if no error handler is specified.
 * @author David Flanagan
 * @param url {String} URL to send the request
 * @param form {Object} DOM node representing the form to process
 * @param callback {Object} Function called to process the XHR response text
 * @param errorHandler {Object} Function called in case of error
 **/
//function XHRpost(url, form, callback, errorHandler) {
//	var method = XHR_POST;
//	var body = encodeForm(form);
//    var request = XHRnewRequest();
//    var resendManager = new XHRResendManager(request, body, method, url);
//    request.onreadystatechange = function() {
//        if (request.readyState == 4) {
//            if (request.status == 200) {
//                callback(XHRgetResponse(request));
//            }
//            else {
//                if (errorHandler) {
//                	resendManager.resend = errorHandler(request.status, request.statusText, request.responseText);
//                	resendManager.sender();
//                }
//            }
//        }
//    };
//
//    request.open(method, url, bModeAsynchrone);
//    // This header tells the server how to interpret the body of the request
//    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
//    // Encode the properties of the values object and send them as
//    // the body of the request.
//	resendManager.sendIterator = 1;
//    request.send(body);
//}


/**
 * Parse an HTTP response based on its Content-Type header
 * and return the parsed object
 * @author David Flanagan
 * @param request {Object} the request
 */
function XHRgetResponse(request) {
    // Check the content type returned by the server
    switch(request.getResponseHeader("Content-Type")) {
    case "text/xml":
        // If it is an XML document, use the parsed Document object
        return request.responseXML;

    case "text/json":
    case "application/json": 
    case "text/javascript":
    case "application/javascript":
    case "application/x-javascript":
        // If the response is JavaScript code, or a JSON-encoded value,
        // call eval() on the text to "parse" it to a JavaScript value.
        // Note: only do this if the JavaScript code is from a trusted server!
        return eval(request.responseText);

    default:
        // Otherwise, treat the response as plain text and return as a string
        return request.responseText;
    }
}

/**
 * Send an HTTP GET request for the specified URL.  If a successful
 * response is received, it is converted to an object based on the
 * Content-Type header and passed to the specified callback function.
 * Additional arguments may be specified as properties of the options object.
 *
 * If an error response is received (e.g., a 404 Not Found error),
 * the status code and message are passed to the options.errorHandler
 * function.  If no error handler is specified, the callback
 * function is called instead with a null argument.
 * 
 * If the options.parameters object is specified, its properties are
 * taken as the names and values of request parameters.  They are
 * converted to a URL-encoded string with encodeForm() and
 * are appended to the URL following a '?'.
 * 
 * If an options.progressHandler function is specified, it is
 * called each time the readyState property is set to some value less
 * than 4.  Each call to the progress handler function is passed an
 * integer that specifies how many times it has been called.
 *
 * If an options.timeout value is specified, the XMLHttpRequest
 * is aborted if it has not completed before the specified number
 * of milliseconds have elapsed.  If the timeout elapses and an
 * options.timeoutHandler is specified, that function is called with
 * the requested URL as its argument.
 **/
//function XHRget(url, callback, form, options) {
//	var method = XHR_GET;
//	var body = null;
//    var request = XHRnewRequest();
//    var resendManager = new XHRResendManager(request, body, method, url);
//
//    var timer;
//    if (options.timeout){
//    	timer = setTimeout(function() {
//        		request.abort();
//                if (options.timeoutHandler){options.timeoutHandler(url);}
//              	}, options.timeout);
//        }
//
//    request.onreadystatechange = function() {
//        if (request.readyState == 4) {
//            if (timer) {clearTimeout(timer);}
//            if (request.status == 200) {
//                callback(XHRgetResponse(request));
//            }
//            else {
//                if (options.errorHandler){
//                    resendManager.resend = options.errorHandler(request.status, request.statusText, request.responseText);
//                	resendManager.sender();
//                }
//            }
//        }
//    };
//
//    var target = url;
//    if (options.parameters){target += "?" + encodeForm(options.form);}
//    //Correction du bug de cache
//    request.open(method, target + "&ms=" + new Date().getTime(), bModeAsynchrone);
//	resendManager.sendIterator = 1;
//    request.send(body);
//}

/**
 * Envoie d'un formulaire via XHR
 * @author Erwan Dorso cgen@airbus.com
 * @param {Object} formToSend Noeud DOM du formulaire
 * @param {Object} callback pointeur vers la fonction appelée au retour du XHR
 * @return false
 */
function XHRsendForm(formToSend, callback){
	var formMethod = formToSend.method;
	var formAction = formToSend.action;
	var options = { 
				parameters : formToSend.elements,
				timeout : XHR_TIMEOUT,
				form : formToSend,
				errorHandler: XHRErrorHandler
				};
	if (formMethod == "post" || formMethod == "POST"){
		XHRSendRequest(formAction, callback, XHR_POST, options);
//		XHRpost(formAction, formToSend, callback, XHRErrorHandler);
	}else{
		XHRSendRequest(formAction, callback, XHR_GET, options);
//		XHRget(formAction,  callback,options);
	}
	return false;
}

/**
 * Gestion d'erreur de l'objet XMLHttpRequest
 * @param {Integer} reqStatus statut de la requete XHR
 * @param {String} reqStatusText Message d'erreur lie au statut de la requete XHR
 * @author Erwan Dorso cgen@airbus.com
 * @throws {Object} Error erreur javacript
 */
function XHRErrorHandler(reqStatus,reqStatusText, responseText){
	
	var resend = true;

    switch(reqStatus) {
    	case 0:
    		//Cas ou la requete est annulee, notamment par depassement du timeout
			alert("CGEN Error Handler : XMLHttpRequest timed out and was aborted.");
			resend = false;
			ASetInhiber(false);
			throw new Error("CGEN Error Handler : XMLHttpRequest timed out and was aborted.");		
			break;
	    case 302:
			if (responseText.indexOf("siteminderagent")>0){
				//Cas ou la session SiteMinder expire
				alert("CGEN Error Handler : SiteMinder session expired, please reconnect");
				resend = false;
				ASetInhiber(false);
				throw new Error("CGEN Error Handler : SiteMinder session expired, please reconnect");
			}
			break;
	    case 12029:
	    case 12030:
	    case 12031:
	    case 12152:
	    case 12159:
			//Cas du bug IE6/Ajax/SSL => on renvoie la requete
	        resend = true;
			break;
		case XHR_RESEND_ERRORSTATUS:
			//Cas du bug IE6/Ajax/SSL ou on a deja renvoye plusieurs fois la requete
			alert("CGEN Error Handler : XMLHttpRequest failed although already sent "+XHR_RESEND_TIMES+" times.");
			resend = false;
			ASetInhiber(false);
			throw new Error("CGEN Error Handler : XMLHttpRequest failed although already sent "+XHR_RESEND_TIMES+" times.");		
			break;
	    default:
	        //Autres cas d'erreur => on affiche une pop up avec le code d'erreur
			alert("CGEN Error Handler : XMLHttpRequest failed. \n HTTP error code :" + reqStatus + "\n Description : " + reqStatusText);
			resend = false;
			ASetInhiber(false);
			throw new Error("CGEN Error Handler : XMLHttpRequest failed. \n HTTP error code :" + reqStatus + "\n Description : " + reqStatusText);		
    }
    return resend;
}

/**
 * Envoie une requete XMLHttpRequest a l'URL specifiee.
 * Recupere la reponse du serveur et la traite en la passant comme argument
 * a la fonction callback passee en parametre.
 * @author Erwan Dorso cgen@airbus.com
 * @param url {String} URL ou la requete doit etre envoyee
 * @param method {String} methode POST ou GET de la requete
 * @param callback {Object} fonction appelee pour traiter le contenu de la reponse texte
 * @param options {Object} options de configuration de la requete : <ul>
 * 		<li>options.errorhandler : fonction appelee pour traiter l'erreur eventuellement
 * 		generee par le serveur</li>
 * 		<li>options.form : noeud DOM representant le  formulaire a traiter</li>
 * 		<li>options.parameters : noeuds DOM representant les elements du formulaire a traiter</li>
 * 		<li>options.timeout : temps au bout duquel la requete sera annulee</li>
 * 		si le serveur ne renvoie pas de reponse</li></ul>
 * @return resendRequest {boolean} true si la requete doit etre relancee, false sinon
 **/
function XHRSendRequest(url, callback, method, options){
	
	var resendRequest = false;
	var resendManager = new XHRResendManager(url, callback, method, options)
	
	//Creation de la requete
    var request = XHRnewRequest();
	
	//Traitement des options
	if(options != null){
		//Si la methode vaut POST et qu'on n'a pas de formulaire alors on renvoie une erreur
		if(method == XHR_POST && options.form == null){
			throw new Error("CGEN Error Handler : a form must be specified to a POST request in XHRSendRequest");
		}
	}else{
		throw new Error("CGEN Error Handler : the options must be specified to XHRSendRequest");		
	}

	//Traitement du corps, de la methode et de l'URL de la requete
	var body;
	var target;
	if (method != null){
		if (method == XHR_GET){
			//Cas d'une requete de type GET
			body = null; //Corps null
			target = url;
			//Encodage d'un formulaire passe en options si necessaire
			if (options.parameters){target += "?" + encodeForm(options.form);}
		    // Introduction d'un parametre aleatoire pour forcer le navigateur
		    // a recreer la requete et ainsi corriger un bug lie a l'utilisation du cache
			target += "&ms=" + new Date().getTime()
		}else if(method == XHR_POST){
			//Cas d'une requete de type POST
			body = encodeForm(options.form); //Le corps de la requete contient le formulaire
			target = url;
		}else{
			throw new Error("CGEN Error Handler : method "+ method +" unrecognized in XHRSendRequest");
		}
	}else{
		throw new Error("CGEN Error Handler : a method must be specified to XHRSendRequest");		
	}

	//Traitement du timer
    var timer;
    if (options.timeout){
    	timer = setTimeout(function() {request.abort();}, options.timeout);
    }

	//configuration du listener pour le traitement de la requete a son retour
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            if (timer) {clearTimeout(timer);}
            if (request.status == 200) {
                callback(XHRgetResponse(request));
                XHR_RESEND_TIMES = 0;
            }
            else {
                if (options.errorHandler){
                    resendManager.resend = options.errorHandler(request.status, request.statusText, request.responseText);
					resendManager.sendIterator++;//inutile
					XHR_RESEND_TIMES++;
                	resendManager.sender();
                }
            }
        }
    };

	//ouverture et configuration de la requete
    request.open(method, target , bModeAsynchrone);
    if(method == XHR_POST){
	    // Cet entete dit au serveur comment interpreter le corps de la requete
	    // dans le cas d'une requete POST
		request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    }
    //envoi de la requete
    request.send(body);

}

/**
 * Objet XHRResendManager vide
 * @constructor
 */
function XHRResendManager(){

	this.resend = false;
	this.sendIterator = 0;
	this.XHRUrl = "";
	this.XHRCallback = null;
	this.XHRMethod = "";
	this.XHROptions = null;

}

/**
 * Objet servant a gerer le renvoi de la requete XHR en cas d'erreur
 * @param {String}aUrl URL ou la requete doit etre envoyee
 * @param {String} aMethod methode POST ou GET de la requete
 * @param {Object} aCallback fonction appelee pour traiter le contenu de la reponse texte
 * @param {Object}aOptions options de configuration de la requete : <ul>
 * 		<li>options.errorhandler : fonction appelee pour traiter l'erreur eventuellement
 * 		generee par le serveur</li>
 * 		<li>options.form : noeud DOM representant le  formulaire a traiter</li>
 * 		<li>options.parameters : noeuds DOM representant les elements du formulaire a traiter</li>
 * 		<li>options.timeout : temps au bout duquel la requete sera annulee</li>
 * 		si le serveur ne renvoie pas de reponse</li></ul>
 * @constructor
 * @author Erwan Dorso cgen@airbus.com
 **/
function XHRResendManager(aUrl, aCallback, aMethod, aOptions){
	this.resend = false;
	this.sendIterator = 0;
	this.XHRUrl = aUrl;
	this.XHRCallback = aCallback;
	this.XHRMethod = aMethod;
	this.XHROptions = aOptions;
}

/**
 * flag pour relancer la requete ou non
 * @type boolean
 */
XHRResendManager.prototype.resend = false;
/**
 * nombre de fois ou la requete a ete relancee
 * @type int 
 */
XHRResendManager.prototype.sendIterator = 0;
/**
 * URL de la requete XHR a relancer
 * @type String
 */
XHRResendManager.prototype.XHRUrl = "";
/**
 * requete XHR a relancer
 * @type Object
 */
XHRResendManager.prototype.XHRCallback = null;
/**
 * methode d'envoi de la requete XHR a relancer
 * @type String
 */
XHRResendManager.prototype.XHRMethod = "";
/**
 * corps de la requete XHR a relancer
 * @type Object
 */
XHRResendManager.prototype.XHROptions = null;
/**
 * fonction de relance de la requete XHR 
 * appelee uniquement en cas d'erreur suite a 
 * un premier envoi.
 * @type Object
 * @author Erwan Dorso cgen@airbus.com
 */
XHRResendManager.prototype.sender = function(){
	if (this.resend && XHR_RESEND_TIMES<XHR_MAX_RESEND_TIMES){
		//On recree une requete avec les memes parametres et on la relance
		XHRSendRequest(this.XHRUrl, this.XHRCallback, this.XHRMethod, this.XHROptions);
		return;
 	}else{
 		XHRErrorHandler(XHR_RESEND_ERRORSTATUS);
 	}
}