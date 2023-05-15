{extends file="main.tpl"}

        
{block name=content}
<div class="table-wrapper">
    <table class="alt">
        <thead>
            <tr>
                <th><b>ID</b></th>
                <th><b>Data</b></th>
                <th><b>Kwota</b></th>
                <th><b>Lata</b></th>
                <th><b>Oprocentowanie</b></th>
                <th><b>Rata</b></th>
            </tr>
        </thead>
        <tbody>
            {foreach $result as $res}
            {strip}
            <tr>
                <td>{$res["id_calc"]}</td>
                <td>{$res["date"]}</td>
                <td>{$res["ammount"]}</td>
                <td>{$res["years"]}</td>
                <td>{$res["interest"]}%</td>
                <td>{$res["loan"]}</td>
            </tr>
            {/strip}
            {/foreach}
        </tbody>
    </table>   
</div>
    
{/block}