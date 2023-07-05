const languages = [
    {
        en: "en",
        no: "non-en",
    },
    {
        en: "Email",
        no: "Epost",
    },
    {
        en: "Password",
        no: "Passord",
    },
    {
        en: "Remember me",
        no: "Husk meg neste gang!",
    },
    {
        en: "Forgot your password?",
        no: "Glemt ditt passord?",
    },
    {
        en: "Already registered?",
        no: "Allerede registrert?",
    },
    {
        en: "LOG IN",
        no: "Logg inn",
    },
    {
        en: "Register",
        no: "Registrere",
    },
    {
        en: "Dashboard",
        no: "Hjem",
    },
    {
        en: "Welcome to Gamehost",
        no: "Velkommen til rebusløp.no",
    },
    {
        en: "Create new game",
        no: "Lag nytt rebusløp",
    },
    {
        en: "=? Existing game",
        no: "Se eksisterende rebusløp",
    },
    {
        en: "+? Existing game",
        no: "Se eksisterende rebusløp",
    },
    {
        en: "Files",
        no: "Filer",
    },
    {
        en: "Profile",
        no: "Din profil",
    },
    {
        en: "Logout",
        no: "Logg ut",
    },
    {
        en: "Published",
        no: "Publisert",
    },
    {
        en: "Team list",
        no: "Lagliste",
    },
    {
        en: "Game started",
        no: "Spillet startet",
    },
    {
        en: "PUBLISHED GAME",
        no: "Antall aktive rebusløp",
    },
    {
        en: "TOTAL GAMEHOST",
        no: "TOTAL SPILLVERT",
    },
    {
        en: "UN PUBLISHED GAME TOTAL",
        no: "Ikke aktiverte rebusløp",
    },
    {
        en: "COMPLETE GAME",
        no: "Ferdige/avsluttede rebusløp",
    },
    {
        en: "Login Page Setup",
        no: "Innloggings side",
    },
    {
        en: "Instruction Setup",
        no: "Rebus instruksjon",
    },
    {
        en: "Task Create",
        no: "Legg til oppgaver",
    },
    {
        en: "Game Details & Welcome Screen",
        no: "Detaljer og velkomstskjerm",
    },
    {
        en: "Login Cover photo",
        no: "Velkomst bilde",
    },
    {
        en: "Shown to players before starting the game.",
        no: "Vist til spillere før du starter spillet.",
    },
    {
        en: "Are you sure to create new game?",
        no: "Er du sikker på at du vil lage et nytt spill?",
    },
    {
        en: "Welcome to Admin dashboard",
        no: "Velkommen til Admin-oversikten",
    },
    {
        en: "TOTAL COMPLETE GAME",
        no: "TOTALT KOMPLETT SPILL",
    },
    {
        en: "Welcome to Gamehost dashboard",
        no: "Velkommen til Gamehost-dashbordet",
    },
    {
        en: "These credentials do not match our records.",
        no: "Disse legitimasjonene samsvarer ikke med opplysningene våre.",
    },
    {
        en: "Cover Photo Upload",
        no: "Last opp bilde",
    },
    {
        en: "Game Title",
        no: "Navn på ditt rebusløp",
    },
    {
        en: "Game Code",
        no: "Rebuskode",
    },
    {
        en: "Game Password",
        no: "Rebus passord",
    },
    {
        en: "Game team",
        no: "Navn på de ulike rebuslagene",
    },
    {
        en: "Photo Stream",
        no: "Vis foto på tvers av rebuslag",
    },
    {
        en: "Show Scoreboard",
        no: "Vis resultat tavle for alle rebuslag",
    },
    {
        en: "Scoreboard",
        no: "Resultattavle",
    },
    {
        en: "Team Scoreboard",
        no: "Vis resultat for rebuslag",
    },
    {
        en: "SL",
        no: "NR",
    },
    {
        en: "Team name",
        no: "Navn på rebuslag",
    },
    {
        en: "Team code",
        no: "Kode for rebuslag",
    },
    {
        en: "Action",
        no: "Handling",
    },
    {
        en: "Click to Publish",
        no: "Klikk for å publisere",
    },
    {
        en: "Default team",
        no: "Lag#1",
    },
    {
        en: "Game start at",
        no: "Spillstart kl",
    },
    {
        en: "Start at",
        no: "Start ved",
    },
    {
        en: "End at",
        no: "Slutt kl",
    },
    {
        en: "Submit",
        no: "Sende inn",
    },
    {
        en: "Submitted answer",
        no: "Innsendt svar",
    },
    {
        en: "User answer",
        no: "Brukersvar",
    },
    {
        en: "Active",
        no: "Aktiv",
    },
    {
        en: "Game host name",
        no: "Spillvertsnavn",
    },
    {
        en: "Unique game host username",
        no: "Unikt brukernavn for spillvert",
    },
    {
        en: "Unique email",
        no: "Unik e-post",
    },
    {
        en: "Game host status",
        no: "Spillvertsstatus",
    },
    {
        en: "Inactive",
        no: "Inaktiv",
    },
    {
        en: "Update",
        no: "Oppdater",
    },
    {
        en: "DATE",
        no: "DATO",
    },
    {
        en: "FIRST NAME",
        no: "FORNAVN",
    },
    {
        en: "LAST NAME",
        no: "ETTERNAVN",
    },
    {
        en: "MESSAGE",
        no: "BESKJED",
    },
    {
        en: "Showing",
        no: "Viser",
    },
    {
        en: "to",
        no: "til",
    },
    {
        en: "of",
        no: "av",
    },
    {
        en: "Entries",
        no: "Innganger",
    },
    {
        en: "Prev",
        no: "Forrige",
    },
    {
        en: "COMPANY",
        no: "SELSKAP",
    },
    {
        en: "Limit",
        no: "Grense",
    },
    {
        en: "Qr code scan result",
        no: "QR-kode skanningsresultat",
    },
    {
        en: "Done",
        no: "Ferdig",
    },
    {
        en: "Media",
        no: "Ferdig",
    },
    {
        en: "Pending",
        no: "Avventer",
    },
    {
        en: "Teamcode",
        no: "Lagkode",
    },
    {
        en: "Teamname",
        no: "Lag navn",
    },
    {
        en: "Gamecode",
        no: "Spillkode",
    },
    {
        en: "teamcode-1",
        no: "Kode#1",
    },
    {
        en: "Next",
        no: "Neste",
    },
    {
        en: "Color",
        no: "Farge",
    },
    {
        en: "Opacity",
        no: "Visuell styrke",
    },
    {
        en: "Image",
        no: "Bilde",
    },
    {
        en: "Show",
        no: "Vis",
    },
    {
        en: "Just text about the game, time limit and how to solve it.,this text should also be restrictied so is fits on maximum two screens scrollingdown.",
        no: "Her kan du skrive kort instruksjon om hvordan rebusløpet kan løses.",
    },
    {
        en: "Your start point",
        no: "Ditt startpunkt",
    },
    {
        en: "Longitude",
        no: "Lengdegrad",
    },
    {
        en: "Latitude",
        no: "Breddegrad",
    },
    {
        en: "This is your game",
        no: "Mini overskrift",
    },
    {
        en: "Get to know paris",
        no: "Bli kjent med Narnia by",
    },
    {
        en: "Grab items, take photos and taste the french cuisine",
        no: "fengende instruksjons tekst  som skaper begeistring.",
    },
    {
        en: "Task Create",
        no: "Legg til oppgaver",
    },
    {
        en: "UploadImage",
        no: "Oppgave med bilde svar",
    },
    {
        en: "Text",
        no: "Oppgave med tekst svar",
    },
    {
        en: "Quiz",
        no: "Oppgave med svar alternativ",
    },
    {
        en: "QRCodeFinder",
        no: "Oppgave med skann av QR",
    },
    {
        en: "upload image",
        no: "Last opp bilde",
    },
    {
        en: "Task Status",
        no: "Oppgavestatus",
    },
    {
        en: "Deadline",
        no: "Frist for levering",
    },
    {
        en: "Point",
        no: "Poeng",
    },
    {
        en: "Points",
        no: "Poeng",
    },
    {
        en: "Max point",
        no: "Maks poeng",
    },
    {
        en: "Game Dashboard",
        no: "Spill Dashboard",
    },
    {
        en: "Task point",
        no: "Max antall poeng",
    },
    {
        en: "Extra Point",
        no: "Ekstra poeng",
    },
    {
        en: "Games",
        no: "Oversikt over antall rebusløp",
    },
    {
        en: "Start Creating Game",
        no: "Lag ny rebus",
    },
    {
        en: "Game host",
        no: "Arrangør",
    },
    {
        en: "Total task",
        no: "Antall oppgaver",
    },
    {
        en: "Status",
        no: "Status",
    },
    {
        en: "Action",
        no: "Handling",
    },
    {
        en: "Copy",
        no: "Kopier innlogginsdata",
    },
    {
        en: "View",
        no: "Re bus",
    },
    {
        en: "Profile Information",
        no: "Informasjon om din profil",
    },
    {
        en: "Recommended Image size should be square (1:1)",
        no: "Anbefalt bildestørrelse bør være kvadratisk (1:1)",
    },
    {
        en: "Ensure your account is using a long, random password to stay secure.",
        no: "Sørg for at kontoen din bruker et langt, tilfeldig passord for å være sikker.",
    },
    {
        en: "Update your account's profile information and email address.",
        no: "Her kan du oppdatere ulike informasjon på din problem",
    },
    {
        en: "Name",
        no: "navn",
    },
    {
        en: "e-mail",
        no: "Epost",
    },
    {
        en: "Instructions",
        no: "Bruksanvisning",
    },
    {
        en: "WriteText",
        no: "Skriv tekst",
    },
    {
        en: "Start task",
        no: "Start oppgave",
    },
    {
        en: "Scan QR",
        no: "Skann QR",
    },
    {
        en: "UploadImage",
        no: "Last opp bilde",
    },
    {
        en: "Your team score",
        no: "Lagets poengsum",
    },
    {
        en: "Photostream",
        no: "bildestrøm",
    },
    {
        en: "Total Score",
        no: "Totale poeng",
    },
    {
        en: "No score found",
        no: "Ingen poengsum funnet",
    },
    {
        en: "QRCodeFinder",
        no: "QR-kodesøker",
    },
    {
        en: "Instruction",
        no: "Instruksjon",
    },
    {
        en: "StartGame",
        no: "Start spill",
    },
    {
        en: "Tasks",
        no: "Oppgaver",
    },
    {
        en: "Home",
        no: "Hjem",
    },
    {
        en: "GAME INFO",
        no: "SPILLINFO",
    },
    {
        en: "Upload Logo/Profile",
        no: "last opp profil logo",
    },
    {
        en: "SAVE",
        no: "lagre",
    },
    {
        en: "Presented By",
        no: "Presentert av",
    },
    {
        en: "Quit",
        no: "Slutte",
    },
    {
        en: "cancel",
        no: "Avbryt",
    },
    {
        en: "SIGN IN",
        no: "Logg inn",
    },
    {
        en: "Update Password",
        no: "oppdater password",
    },
    {
        en: "Ensure your account is using a long, random password to stay secure",
        no: "(Vi anbefaler langt password med bokstaver, tall og spesialtegn)",
    },
    {
        en: "Are you sure you want to delete your account?",
        no: "Er du sikker på at du vil slette kontoen din?",
    },
    {
        en: "Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.",
        no: "Når kontoen din er slettet, slettes alle ressursene og dataene permanent. Skriv inn passordet ditt for å bekrefte at du ønsker å slette kontoen din permanent.",
    },
    {
        en: "Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.",
        no: `Når kontoen din er slettet, slettes alle ressursene og dataene permanent. Før du sletter kontoen din, last ned data eller informasjon du ønsker å beholde.`,
    }, 
    {
        en: "Current Password",
        no: "Nåværende password",
    },
    {
        en: "New Password",
        no: "Nytt passord",
    },
    {
        en: "Confirm Password",
        no: "Bekreft password",
    },
    {
        en: "Delete Account",
        no: "slett konto",
    },
    {
        en: `Once your account is deleted, all of its resources and data will be permanently deleted.
        Before deleting your account, please download any data or information that you wish to
        Retain
        `,
        no: "Om du velger å slette din konto vil all informasjon, inkludert bilder bli slettet permanent.",
    },
    {
        en: `DELETE ACCOUNT`,
        no: "Slett din konto",
    },
]


export default languages