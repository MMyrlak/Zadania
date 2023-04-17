{extends file = "../templates/main.tpl"}

{block name=content}
    <p>{$conf->app_url}</p>
    <form action="{$conf->app_url}/app/calc.php" method="post">
        <div class="row gtr-uniform">
            <div class="col-6 col-12-xsmall">
                <label for="id_amount">Kwota: </label>
                <input id="id_amount" type="text" name="ammonut" value="{$forms->ammount}" placeholder="Kwota" />
            </div>
            <div class="col-6 col-12-xsmall">
                <label for="id_years">Lata: </label>
                <input id="id_years" type="text" name="years" value="{$forms->years}" placeholder="Lata" />
            </div>
            <div class="col-6 col-12-xsmall">
                <label for="id_interest">Oprocentowanie: </label>
                <input id="id_interest" type="text" name="interest" value="{$forms->interes}" placeholder="Oprocentowanie" />
            </div>
            <div class="col-12">
                <ul class="actions">
                    <li><input type="submit" value="Oblicz" class="primary"/></li>
                </ul>
            </div>
        </div>
    </form>	   
        <div class="messeges"> 
            {if $messages->isError()}
                {if count($messages)>0}
                    <h4>Wystapily bledy</h4>
                    <div class="row">
                        <div class="col-6 col-12-medium">
                            <ul class="alt">
                                {foreach $messages->getErrors() as $msg}
                                    {strip}
                                        <li>{$msg}</li>
                                    {/strip}
                                {/foreach}
                            </ul>
                {/if}
            {/if}
                        </div>
                    </div>

            {if isset($result->result)}
                <div class="table-wrapper">
                    <table class="alt">
                        <thead>
                            <tr>
                                <th><b>Kwota</b></th>
                                <th><b>Lata</b></th>
                                <th><b>Oprocentowanie</b></th>
                                <th><b>Rata</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{$forms->ammount}</td>
                                <td>{$forms->years}</td>
                                <td>{$forms->interes}%</td>
                                <td>{$result->result}</td>
                            </tr>
                        </tbody>
                    </table>   
                </div>
            {/if}
        </div>
{/block}