document.addEventListener('DOMContentLoaded', () => {
    const displayTypeSelect = document.getElementById('displayType');
    const displayCategorySelect = document.getElementById('displayCategory');
    const resultsSection = document.getElementById('resultsSection');
    const rankingsSection = document.getElementById('rankingsSection');
    const resultsTable = document.getElementById('resultsTable');
    const rankingsTable = document.getElementById('rankingsTable');
    const rankingsTableHome = document.getElementById('rankingsTableHome');
    const rankingsTableAway = document.getElementById('rankingsTableAway');
    const rankingFilterSelect = document.getElementById('rankingFilter');


    displayTypeSelect.addEventListener('change', () => {
        const selectedOption = displayTypeSelect.value;
        if (selectedOption === 'results') {
            resultsSection.style.display = 'block';
            rankingsSection.style.display = 'none';
        } else if (selectedOption === 'rankings') {
            resultsSection.style.display = 'none';
            rankingsSection.style.display = 'block';
        }
    });

    displayCategorySelect.addEventListener('change', () => {
        const selectedOption = displayCategorySelect.value;

        resultsTable.innerHTML = '';
        rankingsTable.innerHTML = '';
        rankingsTableHome.innerHTML = '';
        rankingsTableAway.innerHTML = '';


        let teamsPromise = fetch('data/teams.json')
            .then(response => response.json())
            .then(teamsData => {

                const teams = teamsData.filter(function (o) {
                    return o.category == selectedOption;
                });

                return teams
            })
            .then(teamsFiltered => {

                let rankings = {};
                let rankings_home = {};
                let rankings_away = {};


                // Initialize rankings
                teamsFiltered.forEach(team => {
                    rankings[team.id] = {
                        id: team.id,
                        name: team.name,
                        points: 0,
                        goalsFor: 0,
                        goalsAgainst: 0,
                        matchesPlayed: 0,
                        wins: 0,
                        draws: 0,
                        losses: 0
                    };
                    rankings_home[team.id] = {
                        id: team.id,
                        name: team.name,
                        points: 0,
                        goalsFor: 0,
                        goalsAgainst: 0,
                        matchesPlayed: 0,
                        wins: 0,
                        draws: 0,
                        losses: 0
                    };
                    rankings_away[team.id] = {
                        id: team.id,
                        name: team.name,
                        points: 0,
                        goalsFor: 0,
                        goalsAgainst: 0,
                        matchesPlayed: 0,
                        wins: 0,
                        draws: 0,
                        losses: 0
                    };

                });


                let resultsPromise = fetch('data/results.json')
                    .then(response => response.json())
                    .then(resultsData => resultsData["category" + selectedOption])
                    .then(resultsFiltered => {
                        const test = rankingFilterSelect.value;
                        console.log(test);


                        const headerRow = resultsTable.insertRow();
                        headerRow.insertCell();
                        teamsFiltered.forEach(team => {
                            const teamCell = headerRow.insertCell();
                            teamCell.textContent = team.name;
                        });

                        teamsFiltered.forEach(team1 => {
                            const newRow = resultsTable.insertRow();
                            const team1HeaderCell = newRow.insertCell();
                            team1HeaderCell.textContent = team1.name; // first column

                            teamsFiltered.forEach(team2 => {
                                const matchResult = resultsFiltered.find(result =>
                                    (result.team1 === team1.id && result.team2 === team2.id)
                                );

                                /////////
                                // RANKINGS CALCULATIONS
                                if (team1.id != team2.id) {
                                    if (matchResult.goals1 > matchResult.goals2) {
                                        rankings[team1.id].points += 3;
                                        rankings[team1.id].wins += 1;
                                        rankings[team2.id].losses += 1;
                                        rankings_home[team1.id].points += 3;
                                        rankings_home[team1.id].wins += 1;
                                        rankings_away[team2.id].losses += 1;
                                    } else if (matchResult.goals1 < matchResult.goals2) {
                                        rankings[team2.id].points += 3;
                                        rankings[team2.id].wins += 1;
                                        rankings[team1.id].losses += 1;
                                        rankings_home[team1.id].losses += 1;
                                        rankings_away[team2.id].points += 3;
                                        rankings_away[team2.id].wins += 1;
                                    } else {
                                        rankings[team1.id].points += 1;
                                        rankings[team2.id].points += 1;
                                        rankings[team1.id].draws += 1;
                                        rankings[team2.id].draws += 1;
                                        rankings_home[team1.id].points += 1;
                                        rankings_home[team1.id].draws += 1;
                                        rankings_away[team2.id].points += 1;
                                        rankings_away[team2.id].draws += 1;
                                    }
                                    rankings[team1.id].goalsFor += matchResult.goals1;
                                    rankings[team2.id].goalsFor += matchResult.goals2;
                                    rankings[team1.id].goalsAgainst += matchResult.goals2;
                                    rankings[team2.id].goalsAgainst += matchResult.goals1;
                                    rankings[team1.id].matchesPlayed += 1;
                                    rankings[team2.id].matchesPlayed += 1;
                                    rankings_home[team1.id].goalsFor += matchResult.goals1;
                                    rankings_home[team1.id].goalsAgainst += matchResult.goals2;
                                    rankings_home[team1.id].matchesPlayed += 1;
                                    rankings_away[team2.id].goalsFor += matchResult.goals2;
                                    rankings_away[team2.id].goalsAgainst += matchResult.goals1;
                                    rankings_away[team2.id].matchesPlayed += 1;
                                }
                                /////////


                                const matchCell = newRow.insertCell();
                                if (team1.id === team2.id) {
                                    matchCell.textContent = '-';
                                    matchCell.id = 'diagonalCell';

                                } else if (matchResult) {
                                    matchCell.textContent = `${matchResult.goals1} - ${matchResult.goals2}`;
                                } else {
                                    matchCell.textContent = '';
                                }
                            })
                        })

                        let rankingsArray = Object.values(rankings);
                        let rankingsArrayHome = Object.values(rankings_home);
                        let rankingsArrayAway = Object.values(rankings_away);


                        function comp(a, b) {
                            if (a.points !== b.points) {
                                return b.points - a.points;
                            }
                            return (b.goalsFor - b.goalsAgainst) - (a.goalsFor - a.goalsAgainst);
                        }

                        rankingsArray.sort(comp);
                        rankingsArrayHome.sort(comp);
                        rankingsArrayAway.sort(comp);


                        return {
                            all: rankingsArray,
                            home: rankingsArrayHome,
                            away: rankingsArrayAway
                        }
                    })
                    .then(rankArrays => {

                        const selectedOption = rankingFilterSelect.value;
                        if (selectedOption === 'all') {
                            rankingsTable.style.display = 'inline-block';
                            rankingsTableHome.style.display = 'none';
                            rankingsTableAway.style.display = 'none';
                        } else if (selectedOption === 'home') {
                            rankingsTable.style.display = 'none';
                            rankingsTableHome.style.display = 'inline-block';
                            rankingsTableAway.style.display = 'none';
                        } else {
                            rankingsTable.style.display = 'none';
                            rankingsTableHome.style.display = 'none';
                            rankingsTableAway.style.display = 'inline-block';
                        }

                        const rankingsArray = rankArrays.all;
                        const rankingsArrayHome = rankArrays.home;
                        const rankingsArrayAway = rankArrays.away;

                        let headerRow = rankingsTable.insertRow();
                        headerRow.insertCell().textContent = 'Rank';
                        headerRow.insertCell().textContent = 'Team';
                        headerRow.insertCell().textContent = 'Points';
                        headerRow.insertCell().textContent = 'Matches';
                        headerRow.insertCell().textContent = 'Wins';
                        headerRow.insertCell().textContent = 'Draws';
                        headerRow.insertCell().textContent = 'Losses';
                        headerRow.insertCell().textContent = 'For';
                        headerRow.insertCell().textContent = 'Against';

                        rankingsArray.forEach((rank, index) => {
                            const newRow = rankingsTable.insertRow();
                            const rankCell = newRow.insertCell();
                            rankCell.textContent = index + 1;
                            const teamNameCell = newRow.insertCell();
                            teamNameCell.textContent = rank.name;
                            newRow.insertCell().textContent = rank.points;
                            newRow.insertCell().textContent = rank.matchesPlayed;
                            newRow.insertCell().textContent = rank.wins;
                            newRow.insertCell().textContent = rank.draws;
                            newRow.insertCell().textContent = rank.losses;
                            newRow.insertCell().textContent = rank.goalsFor;
                            newRow.insertCell().textContent = rank.goalsAgainst;
                        });

                        headerRow = rankingsTableHome.insertRow();
                        headerRow.insertCell().textContent = 'Rank';
                        headerRow.insertCell().textContent = 'Team';
                        headerRow.insertCell().textContent = 'Points';
                        headerRow.insertCell().textContent = 'Matches';
                        headerRow.insertCell().textContent = 'Wins';
                        headerRow.insertCell().textContent = 'Draws';
                        headerRow.insertCell().textContent = 'Losses';
                        headerRow.insertCell().textContent = 'For';
                        headerRow.insertCell().textContent = 'Against';

                        rankingsArrayHome.forEach((rank, index) => {
                            const newRow = rankingsTableHome.insertRow();
                            const rankCell = newRow.insertCell();
                            rankCell.textContent = index + 1;
                            const teamNameCell = newRow.insertCell();
                            teamNameCell.textContent = rank.name;
                            newRow.insertCell().textContent = rank.points;
                            newRow.insertCell().textContent = rank.matchesPlayed;
                            newRow.insertCell().textContent = rank.wins;
                            newRow.insertCell().textContent = rank.draws;
                            newRow.insertCell().textContent = rank.losses;
                            newRow.insertCell().textContent = rank.goalsFor;
                            newRow.insertCell().textContent = rank.goalsAgainst;
                        });

                        headerRow = rankingsTableAway.insertRow();
                        headerRow.insertCell().textContent = 'Rank';
                        headerRow.insertCell().textContent = 'Team';
                        headerRow.insertCell().textContent = 'Points';
                        headerRow.insertCell().textContent = 'Matches';
                        headerRow.insertCell().textContent = 'Wins';
                        headerRow.insertCell().textContent = 'Draws';
                        headerRow.insertCell().textContent = 'Losses';
                        headerRow.insertCell().textContent = 'For';
                        headerRow.insertCell().textContent = 'Against';

                        rankingsArrayAway.forEach((rank, index) => {
                            const newRow = rankingsTableAway.insertRow();
                            const rankCell = newRow.insertCell();
                            rankCell.textContent = index + 1;
                            const teamNameCell = newRow.insertCell();
                            teamNameCell.textContent = rank.name;
                            newRow.insertCell().textContent = rank.points;
                            newRow.insertCell().textContent = rank.matchesPlayed;
                            newRow.insertCell().textContent = rank.wins;
                            newRow.insertCell().textContent = rank.draws;
                            newRow.insertCell().textContent = rank.losses;
                            newRow.insertCell().textContent = rank.goalsFor;
                            newRow.insertCell().textContent = rank.goalsAgainst;
                        });
                    })
            })
    });

    rankingFilterSelect.addEventListener('change', () => {
        let event = new Event('change');
        displayCategorySelect.dispatchEvent(event);
    })



});
