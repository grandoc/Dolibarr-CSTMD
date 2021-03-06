<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) <2018>  saasprov@gmail.com <saasprov.ma>
 * Copyright (C) 2018 Philippe Grand  <philippe.grand@atoo-net.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * \file    admin/setup.php
 * \ingroup CSTMD
 * \brief   Example module setup page.
 *
 * Put detailed description here.
 */

// Load Dolibarr environment
if (false === (@include '../../main.inc.php')) {  // From htdocs directory
	require '../../../main.inc.php'; // From "custom" directory
}

global $langs, $user;

// Libraries
require_once DOL_DOCUMENT_ROOT . "/core/lib/admin.lib.php";
require_once '../lib/icstmd.lib.php';

// Translations
$langs->load("icstmd@icstmd");

if (! $user->admin) accessforbidden();

$action = GETPOST('action','alpha');

if ($action == 'setvalue' && $user->admin)
{
	$db->begin();
    $result=dolibarr_set_const($db, "FOOTER_LIGNE1",GETPOST('FOOTER_LIGNE1','alpha'),'chaine',0,'',$conf->entity);
    if (! $result > 0) $error++;
    $result=dolibarr_set_const($db, "FOOTER_LIGNE2",GETPOST('FOOTER_LIGNE2','alpha'),'chaine',0,'',$conf->entity);
    if (! $result > 0) $error++;
    $result=dolibarr_set_const($db, "FOOTER_LIGNE3",GETPOST('FOOTER_LIGNE3','alpha'),'chaine',0,'',$conf->entity);
    if (! $result > 0) $error++;
    $result=dolibarr_set_const($db, "FOOTER_LIGNE4",GETPOST('FOOTER_LIGNE4','alpha'),'chaine',0,'',$conf->entity);
    if (! $result > 0) $error++;
	
	
	
	//Activate Ask For Preferred Shipping Method

	
	if (! $error)
  	{
  		$db->commit();
  		setEventMessages($langs->trans("SetupSaved"), null, 'mesgs');
  	}
  	else
  	{
  		$db->rollback();
		dol_print_error($db);
    }
}


// Access control
if (! $user->admin) {
	accessforbidden();
}

// Parameters
$action = GETPOST('action', 'alpha');

/*
 * Actions
 */

/*
 * View
 */
$page_name = "CSTMDSetup";
llxHeader('', $langs->trans($page_name));

// Subheader
$linkback = '<a href="'.($backtopage?$backtopage:DOL_URL_ROOT.'/admin/modules.php?restore_lastsearch_values=1').'">'.$langs->trans("BackToModuleList").'</a>';

print load_fiche_titre($langs->trans($page_name), $linkback, 'icstmd@icstmd');

// Configuration header
$head = icstmd_prepare_head();
dol_fiche_head(
	$head,
	'settings',
	$langs->trans("CSTMD"),
	0,
	"icstmd@icstmd"
);

// Setup page goes here
echo $langs->trans("CSTMDSetupPage");

// Test if php curl exist
if (! function_exists('curl_version'))
{
	$langs->load("errors");
	setEventMessages($langs->trans("ErrorPhpCurlNotInstalled"), null, 'errors');
}

print '<form method="post" action="'.$_SERVER["PHP_SELF"].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="setvalue">';

print '<br>';
print '<br>';

print '<table class="noborder" width="100%">';

// Account Parameters
print '<tr class="oddeven"><td class="fieldrequired">';
print $langs->trans("Ligne 1 : ").'</td><td>';
print '<input size="150" type="text" name="FOOTER_LIGNE1" value="'.$conf->global->FOOTER_LIGNE1.'">';
print '</td></tr>';


print '<tr class="oddeven"><td class="fieldrequired">';
print $langs->trans("Ligne 2 : ").'</td><td>';
print '<input size="150" type="text" name="FOOTER_LIGNE2" value="'.$conf->global->FOOTER_LIGNE2.'">';
print '</td></tr>';


print '<tr class="oddeven"><td class="fieldrequired">';
print $langs->trans("Ligne 3 : ").'</td><td>';
print '<input size="150" type="text" name="FOOTER_LIGNE3" value="'.$conf->global->FOOTER_LIGNE3.'">';
print '</td></tr>';


print '<tr class="oddeven"><td class="fieldrequired">';
print $langs->trans("Ligne 4 : ").'</td><td>';
print '<input size="150" type="text" name="FOOTER_LIGNE4" value="'.$conf->global->FOOTER_LIGNE4.'">';
print '</td></tr>';


print '</table>';

dol_fiche_end();

print '<div class="center"><input type="submit" class="button" value="'.$langs->trans("Modify").'"></div>';

print '</form>';

llxFooter();
