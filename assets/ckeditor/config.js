/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

// CKEDITOR.editorConfig = function( config ) {
// 	// Define changes to default configuration here. For example:
// 	// config.language = 'fr';
// 	// config.uiColor = '#AADC6E';
// };

// CKEDITOR.editorConfig = function( config ) {
// 	config.toolbarGroups = [
// 		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
// 		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
// 		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
// 		{ name: 'forms', groups: [ 'forms' ] },
// 		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
// 		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
// 		{ name: 'links', groups: [ 'links' ] },
// 		{ name: 'insert', groups: [ 'insert' ] },
// 		{ name: 'tools', groups: [ 'tools' ] },
// 		{ name: 'colors', groups: [ 'colors' ] },
// 		{ name: 'styles', groups: [ 'styles' ] },
// 		{ name: 'others', groups: [ 'others' ] },
// 		{ name: 'about', groups: [ 'about' ] }
// 	];
// config.height = '50px';
// 	config.removeButtons = 'Save,NewPage,Preview,Print,Templates,Undo,Redo,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,About,ShowBlocks,Flash,Table,Smiley,PageBreak,Iframe,HorizontalRule,Language,Strike,CopyFormatting,NumberedList,BulletedList,Outdent,Indent,Blockquote,CreateDiv,Anchor,Maximize,Cut,Copy,Paste,PasteText,Source,BidiLtr,BidiRtl,Styles,Format,Font,EasyImageUpload';
// };

CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];

	config.removeButtons = 'Save,NewPage,Preview,Print,Templates,Undo,Redo,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,About,ShowBlocks,Flash,Table,Smiley,PageBreak,Iframe,HorizontalRule,Language,Strike,CopyFormatting,NumberedList,BulletedList,Outdent,Indent,Blockquote,CreateDiv,Anchor,Maximize,Cut,Copy,Paste,PasteText,Source,BidiLtr,BidiRtl,Styles,Format,Font,EasyImageUpload,PasteFromWord,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,Link,Unlink,BGColor';
	config.height = '150px';
};