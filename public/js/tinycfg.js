tinymce.init({
    selector: "textarea#richtext",
	//mode : "exact",
	//elements :"#PerguntaPergunta",
	height : 300,
	menubar: false,
	toolbar: [ "undo redo | styleselect | bold italic | link image jbimages | alignleft aligncenter alignright | code" ],
	plugins: ["link", "image", "jbimages", "code"],
	//menu : { // this is the complete default configuration
        //file   : {title : 'File'  , items : 'newdocument'},
        //edit   : {title : 'Edit'  , items : 'undo redo | cut copy paste pastetext | selectall'},
        //insert : {title : 'Insert', items : 'link media | template hr'},
        //view   : {title : 'View'  , items : 'visualaid'},
        //format : {title : 'Format', items : 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
        //table  : {title : 'Table' , items : 'inserttable tableprops deletetable | cell row column'},
        //tools  : {title : 'Tools' , items : 'spellchecker code'}
    //},
	content_css : "/css/fonts.css?" + new Date().getTime() + ",/css/main.css?" + new Date().getTime(),    // resolved to http://domain.mine/mycontent.css
	language : 'pt_BR',
	style_formats: [
        {title: 'Sub-título', block: 'h3', classes: 'subTitulo'},
		{title: 'Referência', selector: 'p', classes: 'referencia'},
    ],
});

//tinymce.init({
//    selector: "textarea#PerguntaA, textarea#PerguntaB, textarea#PerguntaC, textarea#PerguntaD, textarea#PerguntaE",
//	//mode : "exact",
//	//elements :"#PerguntaPergunta",
//	height : 100,
//	menubar: false,
//	toolbar: [ "undo redo | styleselect | bold italic | link image jbimages | alignleft aligncenter alignright | code" ],
//	plugins: ["link", "image", "jbimages", "code"],
//	//menu : { // this is the complete default configuration
//        //file   : {title : 'File'  , items : 'newdocument'},
//        //edit   : {title : 'Edit'  , items : 'undo redo | cut copy paste pastetext | selectall'},
//        //insert : {title : 'Insert', items : 'link media | template hr'},
//        //view   : {title : 'View'  , items : 'visualaid'},
//        //format : {title : 'Format', items : 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
//        //table  : {title : 'Table' , items : 'inserttable tableprops deletetable | cell row column'},
//        //tools  : {title : 'Tools' , items : 'spellchecker code'}
//    //},
//	content_css : "/css/fonts.css?" + new Date().getTime() + ",/css/main.css?" + new Date().getTime(),    // resolved to http://domain.mine/mycontent.css
//	language : 'pt_BR',
//	style_formats: [
//        {title: 'Sub-título', block: 'h3', classes: 'subTitulo'},
//		{title: 'Referência', selector: 'p', classes: 'referencia'},
//    ],
//});