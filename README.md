# Credipass - Calcola Mutuo

**Autore:** Gabriele Piccinnu  
**Agenzia:** Network Vision  
**Descrizione:** Plugin WordPress per calcolare le rate del mutuo, utilizzando i dati Credipass.

## Descrizione

Credipass - Calcola Mutuo è un plugin WordPress sviluppato per un cliente dell'agenzia web Network Vision. Questo plugin permette agli utenti di calcolare le rate del mutuo in base a vari input come l'importo del prestito, il valore della proprietà, la durata del prestito e il tipo di tasso di interesse.

## Caratteristiche

- Calcola le rate del mutuo in base agli input dell'utente.
- Mostra informazioni dettagliate sul mutuo, inclusa la rata mensile, il tasso di interesse e altro.
- Sincronizza i dati dei tassi del mutuo da una fonte esterna.
- Widget amministrativo per sincronizzare manualmente i dati dei tassi del mutuo.

## Installazione

1. Carica la cartella `credipass-calcola-mutuo` nella directory `/wp-content/plugins/`.
2. Attiva il plugin tramite il menu 'Plugin' in WordPress.

## Utilizzo

1. Utilizza lo shortcode `[credipass_calcola_mutuo]` per visualizzare il modulo del calcolatore di mutuo su qualsiasi pagina o post.
2. Il modulo calcolerà automaticamente e mostrerà i dettagli del mutuo in base agli input dell'utente.

## File

- `credipass-calcola-mutuo.php`: File principale del plugin.
- `css/styles.css`: File CSS per gli stili del plugin.
- `js/script.js`: File JavaScript per gestire le interazioni del modulo e i calcoli.
- `templates/form-template.php`: File template per il modulo del calcolatore di mutuo.

## Gestione in backoffice

Il plugin include un widget amministrativo per sincronizzare manualmente i dati dei tassi del mutuo da una fonte esterna. Per utilizzare il widget:

1. Vai alla dashboard di amministrazione di WordPress.
2. Naviga al widget "Credipass - Sincronizza tassi".
3. Clicca sul pulsante "Sincronizza" per recuperare gli ultimi dati dei tassi del mutuo.

## Avvertenza sui marchi

Il marchio Credipass appartiene ai rispettivi proprietari. Questo plugin non è affiliato, approvato o sponsorizzato dai proprietari del marchio Credipass. Tutti i diritti sul marchio appartengono ai rispettivi proprietari.

## Licenza

Questo progetto è sotto licenza MIT - vedi il file [LICENSE](LICENSE) per i dettagli.
