define('Locale', function () {
  /**
   * Locale
   */
  var Locale = {
    'en-US': {
      font: {
        bold: 'Bold',
        italic: 'Italic',
        underline: 'Underline',
        strike: 'Strike',
        clear: 'Remove Font Style',
        height: 'Line Height',
        size: 'Font Size'
      },
      image: {
        image: 'Picture',
        insert: 'Insert Image',
        resizeFull: 'Resize Full',
        resizeHalf: 'Resize Half',
        resizeQuarter: 'Resize Quarter',
        floatLeft: 'Float Left',
        floatRight: 'Float Right',
        floatNone: 'Float None',
        dragImageHere: 'Drag an image here',
        selectFromFiles: 'Select from files',
        url: 'Image URL'
      },
      link: {
        link: 'Link',
        insert: 'Insert Link',
        unlink: 'Unlink',
        edit: 'Edit',
        textToDisplay: 'Text to display',
        url: 'To what URL should this link go?'
      },
      video: {
        video: 'Video',
        videoLink: 'Video Link',
        insert: 'Insert Video',
        url: 'Video URL?',
        providers: '(YouTube, Vimeo, Vine, Instagram, or DailyMotion)'
      },
      table: {
        table: 'Table'
      },
      hr: {
        insert: 'Insert Horizontal Rule'
      },
      style: {
        style: 'Style',
        normal: 'Normal',
        blockquote: 'Quote',
        pre: 'Code',
        h1: 'Header 1',
        h2: 'Header 2',
        h3: 'Header 3',
        h4: 'Header 4',
        h5: 'Header 5',
        h6: 'Header 6'
      },
      lists: {
        unordered: 'Unordered list',
        ordered: 'Ordered list'
      },
      options: {
        help: 'Help',
        fullscreen: 'Full Screen',
        codeview: 'Code View'
      },
      paragraph: {
        paragraph: 'Paragraph',
        outdent: 'Outdent',
        indent: 'Indent',
        left: 'Align left',
        center: 'Align center',
        right: 'Align right',
        justify: 'Justify full'
      },
      color: {
        recent: 'Recent Color',
        more: 'More Color',
        background: 'BackColor',
        foreground: 'FontColor',
        transparent: 'Transparent',
        setTransparent: 'Set transparent',
        reset: 'Reset',
        resetToDefault: 'Reset to default'
      },
      shortcut: {
        shortcuts: 'Keyboard shortcuts',
        close: 'Close',
        textFormatting: 'Text formatting',
        action: 'Action',
        paragraphFormatting: 'Paragraph formatting',
        documentStyle: 'Document Style'
      },
      history: {
        undo: 'Undo',
        redo: 'Redo'
      }
    },

    'nl-NL': {
      font: {
        bold: 'Vet',
        italic: 'Cursief',
        underline: 'Onderstrepen',
        strike: 'Doorhalen',
        clear: 'Stijl verwijderen',
        height: 'Regelhoogte',
        size: 'Tekstgrootte'
      },
      image: {
        image: 'Afbeelding',
        insert: 'Afbeelding invoegen',
        resizeFull: 'Volledige breedte',
        resizeHalf: 'Halve breedte',
        resizeQuarter: 'Kwart breedte',
        floatLeft: 'Links uitlijnen',
        floatRight: 'Rechts uitlijnen',
        floatNone: 'Geen uitlijning',
        dragImageHere: 'Sleep hier een afbeelding naar toe',
        selectFromFiles: 'Selecteer een bestand',
        url: 'URL van de afbeelding'
      },
      link: {
        link: 'Link',
        insert: 'Link invoegen',
        unlink: 'Link verwijderen',
        edit: 'Wijzigen',
        textToDisplay: 'Tekst van link',
        url: 'Naar welke URL moet deze link verwijzen?'
      },
      video: {
        video: 'Video',
        videoLink: 'Video Link',
        insert: 'Insert Video',
        url: 'Video URL?',
        providers: '(YouTube, Vimeo, Vine, Instagram, or DailyMotion)'
      },
      table: {
        table: 'Tabel'
      },
      hr: {
        insert: 'Horizontale lijn invoegen'
      },
      style: {
        style: 'Stijl',
        normal: 'Normaal',
        blockquote: 'Quote',
        pre: 'Code',
        h1: 'Kop 1',
        h2: 'Kop 2',
        h3: 'Kop 3',
        h4: 'Kop 4',
        h5: 'Kop 5',
        h6: 'Kop 6'
      },
      lists: {
        unordered: 'Ongeordende lijst',
        ordered: 'Geordende lijst'
      },
      options: {
        help: 'Help',
        fullscreen: 'Volledig scherm',
        codeview: 'Bekijk Code'
      },
      paragraph: {
        paragraph: 'Paragraaf',
        outdent: 'Inspringen verkleinen',
        indent: 'Inspringen vergroten',
        left: 'Links uitlijnen',
        center: 'Centreren',
        right: 'Rechts uitlijnen',
        justify: 'Uitvullen'
      },
      color: {
        recent: 'Recente kleur',
        more: 'Meer kleuren',
        background: 'Achtergrond kleur',
        foreground: 'Tekst kleur',
        transparent: 'Transparant',
        setTransparent: 'Transparant',
        reset: 'Standaard',
        resetToDefault: 'Standaard kleur'
      },
      shortcut: {
        shortcuts: 'Toetsencombinaties',
        close: 'sluiten',
        textFormatting: 'Tekststijlen',
        action: 'Acties',
        paragraphFormatting: 'Paragraafstijlen',
        documentStyle: 'Documentstijlen'
      },
      history: {
        undo: 'Ongedaan maken',
        redo: 'Opnieuw doorvoeren'
      }
    },

    'de-DE': {
      font: {
        bold: 'Fett',
        italic: 'Kursiv',
        underline: 'Unterstreichen',
        strike: 'Durchgestrichen',
        clear: 'Zur??cksetzen',
        height: 'Zeilenh??he',
        size: 'Schriftgr????e'
      },
      image: {
        image: 'Grafik',
        insert: 'Grafik einf??gen',
        resizeFull: 'Originalgr????e',
        resizeHalf: 'Gr????e 1/2',
        resizeQuarter: 'Gr????e 1/4',
        floatLeft: 'Linksb??ndig',
        floatRight: 'Rechtsb??ndig',
        floatNone: 'Kein Textfluss',
        dragImageHere: 'Ziehen Sie ein Bild mit der Maus hierher',
        selectFromFiles: 'W??hlen Sie eine Datei aus',
        url: 'Grafik URL'
      },
      link: {
        link: 'Link',
        insert: 'Link einf??gen',
        unlink: 'Link entfernen',
        edit: 'Editieren',
        textToDisplay: 'Anzeigetext',
        url: 'Ziel des Links?'
      },
      video: {
        video: 'Video',
        videoLink: 'Video Link',
        insert: 'Insert Video',
        url: 'Video URL?',
        providers: '(YouTube, Vimeo, Vine, Instagram, or DailyMotion)'
      },
      table: {
        table: 'Tabelle'
      },
      hr: {
        insert: 'Eine horizontale Linie einf??gen'
      },
      style: {
        style: 'Stil',
        normal: 'Normal',
        blockquote: 'Zitat',
        pre: 'Quellcode',
        h1: '??berschrift 1',
        h2: '??berschrift 2',
        h3: '??berschrift 3',
        h4: '??berschrift 4',
        h5: '??berschrift 5',
        h6: '??berschrift 6'
      },
      lists: {
        unordered: 'Aufz??hlung',
        ordered: 'Nummerieung'
      },
      options: {
        help: 'Hilfe',
        fullscreen: 'Vollbild',
        codeview: 'HTML-Code anzeigen'
      },
      paragraph: {
        paragraph: 'Absatz',
        outdent: 'Einzug vergr????ern',
        indent: 'Einzug verkleinern',
        left: 'Links ausrichten',
        center: 'Zentriert ausrichten',
        right: 'Rechts ausrichten',
        justify: 'Blocksatz'
      },
      color: {
        recent: 'Letzte Farbe',
        more: 'Mehr Farben',
        background: 'Hintergrundfarbe',
        foreground: 'Schriftfarbe',
        transparent: 'Transparenz',
        setTransparent: 'Transparenz setzen',
        reset: 'Zur??cksetzen',
        resetToDefault: 'Auf Standard zur??cksetzen'
      },
      shortcut: {
        shortcuts: 'Tastenk??rzel',
        close: 'Schlie??en',
        textFormatting: 'Textformatierung',
        action: 'Aktion',
        paragraphFormatting: 'Absatzformatierung',
        documentStyle: 'Dokumentenstil'
      },
      history: {
        undo: 'R??ckg??ngig',
        redo: 'Wiederholen'
      }
    },

    'ko-KR': {
      font: {
        bold: '??????',
        italic: '????????????',
        underline: '??????',
        strike: '?????????',
        clear: '?????? ?????? ?????????',
        height: '?????????',
        size: '?????? ??????'
      },
      image: {
        image: '??????',
        insert: '?????? ??????',
        resizeFull: '?????? ????????? ??????',
        resizeHalf: '50% ????????? ??????',
        resizeQuarter: '25% ????????? ??????',
        floatLeft: '?????? ??????',
        floatRight: '????????? ??????',
        floatNone: '???????????? ??????',
        dragImageHere: '????????? ???????????? ???????????????',
        selectFromFiles: '?????? ??????',
        url: '?????? URL'
      },
      link: {
        link: '??????',
        insert: '?????? ??????',
        unlink: '?????? ??????',
        edit: '??????',
        textToDisplay: '????????? ????????? ??????',
        url: '????????? URL'
      },
      video: {
        video: '?????????',
        videoLink: '????????? ??????',
        insert: '????????? ??????',
        url: '????????? URL?',
        providers: '(YouTube, Vimeo, Vine, Instagram, DailyMotion ?????? ??????)'
      },
      table: {
        table: '?????????'
      },
      hr: {
        insert: '????????? ??????'
      },
      style: {
        style: '?????????',
        normal: '??????',
        blockquote: '?????????',
        pre: '??????',
        h1: '?????? 1',
        h2: '?????? 2',
        h3: '?????? 3',
        h4: '?????? 4',
        h5: '?????? 5',
        h6: '?????? 6'
      },
      lists: {
        unordered: '????????? ??????',
        ordered: '?????? ?????????'
      },
      options: {
        help: '?????????',
        fullscreen: '?????? ??????',
        codeview: '?????? ??????'
      },
      paragraph: {
        paragraph: '?????? ??????',
        outdent: '????????????',
        indent: '????????????',
        left: '?????? ??????',
        center: '????????? ??????',
        right: '????????? ??????',
        justify: '?????? ??????'
      },
      color: {
        recent: '??????????????? ????????? ???',
        more: '?????? ??? ??????',
        background: '?????????',
        foreground: '?????????',
        transparent: '??????',
        setTransparent: '??????',
        reset: '??????',
        resetToDefault: '?????? ????????? ??????'
      },
      shortcut: {
        shortcuts: '????????? ?????????',
        close: '??????',
        textFormatting: '?????? ????????? ??????',
        action: '??????',
        paragraphFormatting: '?????? ????????? ??????',
        documentStyle: '?????? ????????? ??????'
      },
      history: {
        undo: '?????? ??????',
        redo: '?????? ??????'
      }
    }
  };

  return Locale;
});
