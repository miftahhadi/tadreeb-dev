/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
    config.removeDialogTabs = 'image:advanced;link:advanced';
    
    config.contentsCss = 'https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400%3b0,700%3b1,400%3b1,700&family=Aref+Ruqaa:wght@400%3b700&family=Cairo:wght@200%3b300%3b400%3b600%3b700%3b900&family=Lateef&family=Markazi+Text:wght@400%3b500%3b600%3b700&family=Scheherazade:wght@400%3b700&display=swap';

	config.font_names = config.font_names + ';' + 'Amiri/Amiri;' + 'Aref Ruqaa/Aref Ruqaa;' + 'Cairo/Cairo;' + 'Lateef/Lateef;' + 'Scheherazade;' + 'Markazi/Markazi;';
};
