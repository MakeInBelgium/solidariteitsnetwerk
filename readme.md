# SolidariteitsNetwerk

## Wat
Dit is een initiële set-up voor Solidariteitsnetwerk.be. Een platform om vrijwilligers aan hulpbehoevende senioren te koppelen. Momenteel is er een "minimum viable product", dwz een eerste versie waarop verder gewerkt moet worden. Dit is dus nog **niet** klaar om in productie te gaan.

In dit Google document staat de huidige hulpvraag beschreven: https://docs.google.com/document/d/1ZnXAI-azK7N9eYgHJG8rdG28SyDulTZgV5v_gHaHlPY/edit?usp=sharing.

## Help wanted
De basis is gelegd. Er is bewezen wat er op korte tijd zoal mogelijk is om te bouwen, de volgende stap is vooral mensen bij elkaar zoeken die kunnen en willen helpen.

**Kan jij helpen met:**
* De ontwikkeling (zie kopje *tech*)
* Projectmanagement
* Testing
* Meedenken over richting en strategie?

*Join the fun!* Neem dan deel aan de conversatie op de Slack workspace van de Corona-denktank Make in Belgium: https://join.coronadenktank.be (Kanaal: #corona-seniorennet).

## Tech used
Het platform werkt op basis van [API-Platform](https://www.api-platform.com): 
* Een API-first backend in [Symfony framework](https://symfony.com/), er wordt automatisch API documentatie gegenereerd op basis van `annotations` in de `Entity` classes.
* Een admin-omgeving gebaseerd op [react-admin](https://marmelab.com/react-admin/) die grotendeels automatisch een paneel met beheerschermen genereert op basis van de API-documentatie.

## Voorbeeld
* **Administratiepaneel**: https://admin.zorglijn.neok.be/
    * **Username**: vdwijngaert
    * **Password**: SuperSecurePassword
* **API + documentatie**: https://api.zorglijn.neok.be/ 

