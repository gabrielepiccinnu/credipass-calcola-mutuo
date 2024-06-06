function calcolaMutuo() {
    try {
        const tassi = dtTassi_MUT;
        const tassiKey = dtTassi_MUT_key;

        const importoRichiesto = parseNumber(document.getElementById('importoRichiestoMut').value);
        const valoreImmobile = parseNumber(document.getElementById('valoreImmobile').value);
        const durataAnni = parseInt(document.getElementById('durataAnni').value);
        const tipoTasso = document.querySelector('input[name="tipoDiTasso"]:checked').value;
        const finalita = document.getElementById('finalita').value;

        // Mappa per finalità del mutuo
        const finalitaMap = {
            'Acquisto Prima Casa': 'ACQ1',
            'Ristrutturazione Casa': 'RISTR',
            'Costruzione Casa': 'COSTR',
            'Consolidamento Debiti': 'CONS',
            'Liquidita': 'LIQ',
            'Surroga': 'SURR'
        };

        let ltv = 0;
        if (valoreImmobile > 0) {
            ltv = importoRichiesto / valoreImmobile;
        }

        const ltvCategory = ltv >= 1 ? 100 : ltv >= 0.8 ? 80 : ltv >= 0.6 ? 60 : 50;

        const tassoEntry = tassi.find(entry => 
            entry[tassiKey.Finalita] === finalitaMap[finalita] &&
            entry[tassiKey.TipoDiTasso] === tipoTasso &&
            entry[tassiKey.Durata] === durataAnni &&
            entry[tassiKey.LTV] === ltvCategory
        );

        if (tassoEntry) {
            const tasso = tassoEntry[tassiKey.Tasso] || 0;
            const rata = calcolaRata(importoRichiesto, tasso, durataAnni);
            const daIntegrare = valoreImmobile - importoRichiesto;

            document.getElementById('rataMut').textContent = formatCurrency(rata);
            document.getElementById('importoRichiesto_TxtMut').textContent = formatCurrency(importoRichiesto);
            document.getElementById('capitaleRichiestoMut').textContent = formatCurrency(daIntegrare);
            document.getElementById('ltvMut').textContent = (ltv * 100).toFixed(2) + '%';
            document.getElementById('tassoMut').textContent = tasso.toFixed(2) + '%';
            document.getElementById('euriborEurirsMut').textContent = (tassoEntry[tassiKey.EuriborEurirs] || 0).toFixed(2) + '%';
            document.getElementById('spreadMut').textContent = (tassoEntry[tassiKey.Spread] || 0).toFixed(2) + '%';
            document.getElementById('taegMut').textContent = (tassoEntry[tassiKey.Taeg] || 0).toFixed(2) + '%';

            if (daIntegrare <= 0) {
                document.getElementById('zeroAnticipo').style.display = '';
                document.getElementById('not-zeroAnticipo').style.display = 'none';
            } else {
                document.getElementById('zeroAnticipo').style.display = 'none';
                document.getElementById('not-zeroAnticipo').style.display = '';
            }
        } else {
            console.error('Tasso entry non trovata');
            document.getElementById('rataMut').textContent = 'N.D.';
        }
    } catch (error) {
        console.error('Errore nel recupero dei tassi:', error);
    }
}

function parseNumber(value) {
    return isNaN(value) || value === '' ? 0 : parseFloat(value);
}

function formatCurrency(value) {
    return parseFloat(value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '€';
}

function calcolaRata(importo, tasso, durata) {
    const mesi = durata * 12;
    const tassoMensile = tasso / 100 / 12;
    const rata = importo * tassoMensile / (1 - Math.pow(1 + tassoMensile, -mesi));
    return rata.toFixed(2);
}

jQuery(document).ready(function($) {
    $('#credipass-sync-button').on('click', function() {
        var $status = $('#credipass-sync-status');
        $status.text('Sincronizzazione in corso...');
        
        $.ajax({
            url: credipassData.ajaxUrl,
            type: 'POST',
            data: {
                action: 'credipass_calcola_mutuo_sync_tassi'
            },
            success: function(response) {
                if (response.success) {
                    $status.text(response.data);
                } else {
                    $status.text(response.data);
                }
            },
            error: function() {
                $status.text('Errore durante la sincronizzazione.');
            }
        });
    });

    // Event listeners per i cambiamenti dei campi del modulo
    $('#finalita, #importoRichiestoMut, #valoreImmobile, #durataAnni').on('change input', function() {
        calcolaMutuo();
    });

    $('input[name="tipoDiTasso"]').on('change', function() {
        calcolaMutuo();
    });

    // Calcola i valori al caricamento della pagina
    calcolaMutuo();
});
