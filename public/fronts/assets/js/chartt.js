document.addEventListener("DOMContentLoaded", function() {
    if (typeof voirChiffreAffaire !== 'undefined' && voirChiffreAffaire.length > 0) {
        const dates = voirChiffreAffaire.map(item => item.dates);
        const totalSumPrices = voirChiffreAffaire.map(item => item.totalSumPrice);

        const ctx = document.getElementById('chiffreAffaireChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Chiffre d\'affaires (Ar)',
                    data: totalSumPrices,
                    backgroundColor: 'rgba(106, 17, 203, 0.6)',
                    borderColor: 'rgba(106, 17, 203, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        callbacks: {
                            label: function(context) {
                                return `Chiffre d'affaires : ${context.raw.toLocaleString()} Ar`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Dates',
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Chiffre d\'affaires (Ar)',
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        },
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString() + ' Ar';
                            }
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuad'
                }
            }
        });
    } else {
        console.warn("Aucune donnée disponible pour afficher le graphique.");
    }
});
