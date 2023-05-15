{if $msgs->isError()}
                <div class="messeges"> 
                    <h4>Wystapily bledy</h4>
                    <div class="row">
                        <div class="col-6 col-12-medium">
                            <ul class="alt">
                                {foreach $msgs->getErrors() as $err}
                                {strip}
                                        <li>{$err}</li>
                                {/strip}
                                {/foreach}
                            </ul>
                        </div>
                   </div>
            </div>
            {/if}
