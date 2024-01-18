<div class="row">
            <div class="col mx-auto">
                <div class="card rounded-0 border-0 shadow">
                    <div class="card-body p-5">
                        
                        <!--  Bootstrap table-->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Codice Prodotto</th>
                                        <th scope="col">Codice Prodotto Int.</th>
                                        <th scope="col">Descrizione</th>
                                        <th scope="col">Quantita</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
     
                                    <?php
                                        if(isset($righe)){
                                            foreach($righe as &$var){
                                                echo (render_riga_ordine($var['codice'],$var['codice_prodotto'],$var['codice_prodotto_int'],$var['descrizione'],$var['quantita']));
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Add rows button-->
                        <a class="btn btn-primary rounded-0 btn-block" id="insertRow" href="#">Add new row</a>
                        <a class="btn btn-warning rounded-0 btn-block" id="insertRow" href="#">Close order</a>
                    </div>
                </div>
            </div>
</div>