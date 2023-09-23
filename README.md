1. Przygotowanie odpowiednich modeli i ewentualnych kontrolerów, migracji i ustalenie potencjalnych relacji między modelami.
UserController: Zarządzanie użytkownikami (rejestracja, logowanie i zarządzanie profilem gracza).
CardController: Zarządzanie kartami (dodawanie, usuwanie i przeglądanie kart, dla admina przeglądanie kart graczy).
GameController: Zarządzanie grami (rozpoczynanie nowych gier, dołączanie do gier, wybieranie kart, itp.).
LevelController: Zarządzanie poziomami rozgrywki (wyświetlanie dostępnych poziomów gry i ich szczegółów).
MatchGameController: Zarządzania pojedynkami między graczami (tworzenie nowych pojedynków i dołączanie do istniejących).
MatchHistoryController: Wyświetlanie historii pojedynków gracza.
ActiveMatchController: Wyświetlania aktywnych pojedynków gracza oraz możliwości dołączenia lub rezygnacji z nich.
GameLogController: Zapisywanie / przeglądanie logów gry, które zawierają informacje o aktywnościach graczy podczas rozgrywki.

2. Przygotowanie polityk dostępu do poszczególnych metod.
AdminPolicy: odpowiada za kontrolę dostępów admina 
CardPolicy: odpowiada za kontrolę operacji na kartach
GamePolicy: odpowiada za kontrolę dostępów do konkretnej gry
Pojedynki poszczególnych gier będą kontrolowane przez te same zasady co w GamePolicy
