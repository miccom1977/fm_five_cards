1. Przygotowanie odpowiednich modeli i ewentualnych kontrolerów, migracji i ustalenie potencjalnych relacji między modelami<br><br>
UserController: Zarządzanie użytkownikami (rejestracja, logowanie i zarządzanie profilem gracza).<br>
CardController: Zarządzanie kartami (dodawanie, usuwanie i przeglądanie kart, dla admina przeglądanie kart graczy).<br>
GameController: Zarządzanie grami (rozpoczynanie nowych gier, dołączanie do gier, wybieranie kart, itp.).<br>
LevelController: Zarządzanie poziomami rozgrywki (wyświetlanie dostępnych poziomów gry i ich szczegółów).<br>
MatchGameController: Zarządzania pojedynkami między graczami (tworzenie nowych pojedynków i dołączanie do istniejących).<br>
MatchHistoryController: Wyświetlanie historii pojedynków gracza.<br>
ActiveMatchController: Wyświetlania aktywnych pojedynków gracza oraz możliwości dołączenia lub rezygnacji z nich.<br>
GameLogController: Zapisywanie / przeglądanie logów gry, które zawierają informacje o aktywnościach graczy podczas rozgrywki.<br><br><br>

2. Przygotowanie polityk dostępu do poszczególnych metod.<br><br>
AdminPolicy: odpowiada za kontrolę dostępów admina <br>
CardPolicy: odpowiada za kontrolę operacji na kartach<br>
GamePolicy: odpowiada za kontrolę dostępów do konkretnej gry<br>
Pojedynki poszczególnych gier będą kontrolowane przez te same zasady co w GamePolicy<br><br><br>
