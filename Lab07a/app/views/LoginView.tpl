{extends file="main.tpl"}

{block name=content}
    <form action="{$conf->action_root}login" method="post">
        <div class="row gtr-uniform">
            <div class="col-6 col-12-xsmall">
                <label for="id_login">Login: </label>
                <input id="id_login" type="text" name="login" />
            </div>
            <div class="col-6 col-12-xsmall">
                <label for="id_pass">Haslo: </label>
                <input id="id_pass" type="password" name="pass"/>
            </div>
            <div class="col-12">
                <ul class="actions">
                    <li><input type="submit" value="zaloguj" class="primary"/></li>
                </ul>
            </div>
        </div>
    </form>
    
    {include file='messages.tpl'}
{/block}
