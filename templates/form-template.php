<div class="container calc-form form-calc-wrapper" id="form-calc-mutuo">
    <input type="hidden" name="formtype" value="mutuo">
    <input type="hidden" name="tipoDiPratica" value="MUT">

    <div class="alert alert-danger" role="alert" id="alertRicalcola" style="display: none;">
        - - -
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="d-flex">
                <div style="display: none;" class="form-number">1</div>
                <div>
                    <h3>Scopri il mutuo migliore</h3>
                    <p class="small">Calcola la rata e trova quella giusta per te.</p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="finalita">Finalità del mutuo</label>
                <select class="custom-select form-control fieldRata" name="finalita" id="finalita">
                    <option value="Acquisto Prima Casa" selected="">Acquisto Casa</option>
                    <option value="Ristrutturazione Casa">Ristrutturazione Casa</option>
                    <option value="Costruzione Casa">Costruzione Casa</option>
                    <option value="Consolidamento Debiti">Consolidamento Debiti</option>
                    <option value="Liquidita">Liquidità</option>
                    <option value="Surroga">Surroga</option>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="durata">Durata (anni)</label>
                <select class="custom-select form-control fieldRata" name="durataAnni" id="durataAnni">
                    <option value="10">10 anni</option>
                    <option value="15">15 anni</option>
                    <option value="20">20 anni</option>
                    <option value="25">25 anni</option>
                    <option value="30" selected="">30 anni</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="importo">Importo richiesto</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="euro-symbol">€</span>
                    </div>
                    <input type="number" class="form-control fieldRata" name="importoRichiesto" id="importoRichiestoMut" onclick="this.select();" min="50000" aria-describedby="euro-symbol" value="120000" data-parsley-group="block-1" required="">
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="val-immobile">Costo immobile</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="euro-symbol_immobile">€</span>
                    </div>
                    <input type="number" class="form-control fieldRata" name="valoreImmobile" id="valoreImmobile" onclick="this.select();" min="0" aria-describedby="euro-symbol_immobile" value="150000" data-parsley-group="block-1" data-parsley-gte="#importoRichiestoMut" required="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="form-group form-inline">
                <div class="tasso-checkbox form-check-inline">
                    <label for="tasso">Tipo di Tasso</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input fieldRata" type="radio" name="tipoDiTasso" id="tipoDiTasso-V" value="V" data-parsley-multiple="tipoDiTasso">
                    <label class="form-check-label" for="tipoDiTasso-V">Variabile</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input fieldRata" type="radio" name="tipoDiTasso" id="tipoDiTasso-F" value="F" checked="" data-parsley-multiple="tipoDiTasso">
                    <label class="form-check-label" for="tipoDiTasso-F">Fisso</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-md-12">
            <div class="offerta-container">
                <div class="row no-gutters align-items-end">
                    <div class="col-6 pl-3 pb-2">
                        <h6 class="rata">Rata Mutuo</h6>
                        <div class="rata">
                            <h3 class="rata-value" id="rataMut">480.41€</h3>
                            <span class="al-mese small">Al mese</span>
                        </div>
                    </div>
                    <div class="col-6 pb-2">
                        <div class="dettagli-offerta">
                            Spread: <span id="spreadMut">0.09%</span>
                            <br>
                            Euribor/Euris: <span id="euriborEurirsMut">2.51%</span>
                            <br>
                            Tasso: <span id="tassoMut">2.60%</span>
                            <br>
                            Taeg: <span id="taegMut">2.68%</span>
                            <br>
                            LTV: <span id="ltvMut">80%</span>
                        </div>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-6 pl-3">
                        <div class="dettagli-offerta">
                            <h6><span id="zeroAnticipo" style="display: none;" class="zero-anticipo">ZERO ANTICIPO!</span></h6>                    
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dettagli-offerta">
                            Finanziamento: <span id="importoRichiesto_TxtMut">120,000.00€</span>
                            <div id="not-zeroAnticipo">Da integrare: <span id="capitaleRichiestoMut">30,000.00€</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rata-info">     
        <div class="form-info">
            La rata indicata è la più vantaggiosa ed è il risultato di una selezione algoritmica eseguita sulla base dei dati disponibili sulla piattaforma banche di Credipass. L’importo è pubblicato a fini meramente informativi e potrà esserti confermato o ricalcolato in esito all’intervento di Credipass ed in funzione dei parametri di credito delle banche e/o di altri finanziatori.
        </div>
    </div>
</div>
