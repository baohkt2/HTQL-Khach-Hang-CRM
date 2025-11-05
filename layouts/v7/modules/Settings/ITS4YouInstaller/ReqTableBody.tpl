{* ********************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** *}
{strip}
    <tbody>
        {foreach from=$VALUES key=NAME item=DATA}
            <tr class="{$DATA['error']}Error {$DATA['warning']}Warning">
                <td><b>{vtranslate($NAME, $QUALIFIED_MODULE)}</b> {if $DATA['info']}({vtranslate($DATA['info'], $QUALIFIED_MODULE)}){/if}</td>
                <td>{$DATA['current']}</td>
                <td>{$DATA['minimum']}</td>
                <td>{$DATA['recommended']}</td>
            </tr>
        {/foreach}
    </tbody>
{/strip}