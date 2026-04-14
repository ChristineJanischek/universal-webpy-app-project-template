# PFLICHTENHEFT: Universal WebPy App Project Template

**Dokumentversion:** 2.0  
**Datum:** 14. April 2026  
**Status:** Aktiv  
**Letzter Autor:** Systemanforderungen  

---

## 1. Zielstellung & Motivation

### 1.1 Allgemeines Ziel
Aufbau einer **universellen, produktionsreifen Webanwendung** als Projektvorlage für schulische und kommerzielle Informatik-Projekte. Das System demonstriert professionelle Architektur, Sicherheitsstandards, Dokumentation und Best Practices für moderne Softwareentwicklung im vollen Stack (Frontend, Backend, Datenbank, Desktop-Komponenten).

### 1.2 Spezifische Ziele

**Technologische Ziele:**
- Multi-Stack-Lösung: Python, PHP, JavaScript, MySQL, Java, React Framework
- Responsive und mobile-optimierte Benutzeroberfläche
- Modulare API-Architektur mit Wiederverwendbarkeit
- MVC-Pattern durchgängig implementiert

**Qualitätsziele:**
- Redundanzfreies System (Code und Dokumentation)
- Lückenlose Dokumentation (Handbuch & Pflichtenheft)
- Automatisierte Validierung und Quality Gates
- Persistente Live-Testumgebung
- Sichere und wartbare Codebasis

**Architekturziele:**
- OOP-Prinzipien konsequent umgesetzt (Abstraktion, Vererbung, Kapselung, Polymorphie)
- Modular und erweiterbar nach Divide-and-Conquer-Prinzip
- Testbare Einheiten (Unit Tests) für alle Komponenten
- Automatisierte Prozesse und Routinen

---

## 2. Anforderungen

### 2.1 Funktionale Anforderungen (FA)

#### FA1: Webbasierte Anwendung
- **FA1.1:** Responsive Design für alle Bildschirmgrößen (Mobile, Tablet, Desktop)
- **FA1.2:** Frontend mit React Framework oder modernem JavaScript
- **FA1.3:** PHP/JavaScript-basierte Web-Views mit dynamischer Inhaltsladung
- **FA1.4:** RESTful API mit Python (Flask/Django)
- **FA1.5:** Volles Datenbankmanagement mit MySQL

#### FA2: Architecture & Design Patterns
- **FA2.1:** MVC-Architektur durchgängig implementiert
- **FA2.2:** Klare Trennung von Model, View, Controller
- **FA2.3:** Modularer Aufbau mit eigenständigen Libraries und APIs
- **FA2.4:** Containerisierung mit Docker für alle Services

#### FA3: Objektorientierte Programmierung
- **FA3.1:** Abstraktion: Klassen für alle Domänen-Entities
- **FA3.2:** Vererbung: Struktur mit Super- und Subklassen
- **FA3.3:** Kapselung: Rechtesystem und private/protected Zugriff
- **FA3.4:** Polymorphie: Unterschiedliche Implementierungen gleicher Interfaces
- **FA3.5:** DRY-Prinzip: Keine Codewiederholungen

#### FA4: Wiederverwendbarkeit
- **FA4.1:** Zentrale API-Endpoints für alle Datenoperationen
- **FA4.2:** Wiederverwendbare Komponenten-Libraries
- **FA4.3:** Standardisierte Utility-Funktionen
- **FA4.4:** Service-Layer für Business-Logik

#### FA5: Testbarkeit & Quality Gates
- **FA5.1:** Unit Tests für kritische Komponenten
- **FA5.2:** Automatisierte Sicherheitsprüfungen
- **FA5.3:** Architektur-Validierung vor Deployment
- **FA5.4:** Dokumentations-Validierung
- **FA5.5:** Live-Testumgebung fortwährend verfügbar

#### FA6: Sicherheit (Security & Safety)
- **FA6.1:** Keine Secrets im Repository (Umgebungsvariablen)
- **FA6.2:** HTTPS für alle Kommunikation
- **FA6.3:** Input-Validierung und Sanitization
- **FA6.4:** SQL-Injection-Prevention durch Prepared Statements
- **FA6.5:** XSS-Prevention durch Output-Encoding
- **FA6.6:** CSRF-Token für Formulare
- **FA6.7:** Passwort-Hashing mit modernen Algorithmen (bcrypt/Argon2)
- **FA6.8:** Authentifizierung und Autorisierung
- **FA6.9:** Audit-Logging für kritische Operationen
- **FA6.10:** Datenbankbackups und Recovery-Plan
- **FA6.11:** Fehlerbehandlung ohne sensible Daten an Clients

#### FA7: Automatisierung
- **FA7.1:** Kontinuierliche Integration (CI/CD)
- **FA7.2:** Automatisierte Deployments
- **FA7.3:** Monitoring und Alerting
- **FA7.4:** Backup-Routinen täglich
- **FA7.5:** Log-Rotation und Cleanup

### 2.2 Nicht-funktionale Anforderungen (NFA)

#### NFA1: Redundanzfreiheit
- **NFA1.1:** Keine duplizierten Codeteile
- **NFA1.2:** Keine redundanten Dokumentationen
- **NFA1.3:** Single Source of Truth (SSOT) für alle Konfigurationen
- **NFA1.4:** Gemeinsame Funktionen in Shared Libraries

#### NFA2: Dokumentation
- **NFA2.1:** Vollständiges Handbuch mit Installationsanleitung
- **NFA2.2:** API-Dokumentation (OpenAPI/Swagger)
- **NFA2.3:** Architektur-Dokumentation mit Diagrammen
- **NFA2.4:** Code-Kommentare für komplexe Logik
- **NFA2.5:** Changelog für alle Versionen
- **NFA2.6:** README in jedem Verzeichnis

#### NFA3: Sicherheit & Safety
- **NFA3.1:** Betriebssicherheit: Monitoring, Logging, Alerting
- **NFA3.2:** Netzwerksicherheit: Firewall-Regeln, SSL/TLS
- **NFA3.3:** Datenschutz: GDPR-konform, Verschlüsselung sensitiver Daten
- **NFA3.4:** Backup-Strategie: Tägliche Inkrementelle, wöchentliche vollständige
- **NFA3.5:** Disaster Recovery: RPO ≤ 1 Tag, RTO ≤ 4 Stunden
- **NFA3.6:** Abhängigkeits-Management: Security-Updates automatisch geprüft

#### NFA4: Wartbarkeit
- **NFA4.1:** Modularer Code für einfache Wartung
- **NFA4.2:** Konsistente Namenskonventionen
- **NFA4.3:** Versionskontrolle (Git) für alle Änderungen
- **NFA4.4:** Code-Reviews vor jedem Merge
- **NFA4.5:** Automatisierte Code-Formatierung

#### NFA5: Erweiterbarkeit
- **NFA5.1:** Plugin-architektur für neue Features
- **NFA5.2:** Konfigurationsdateien für Deployment-Anpassung
- **NFA5.3:** API-Versioning für Abwärtskompatibilität
- **NFA5.4:** Modularer Datenbank-Schema

#### NFA6: Performance
- **NFA6.1:** Datenbankindizes für häufige Abfragen
- **NFA6.2:** Caching-Strategien implementiert
- **NFA6.3:** Frontend-Optimierung (Bundling, Minimierung)
- **NFA6.4:** Response-Zeit < 200ms für kritische Operationen

#### NFA7: Persistenz & Datenbank
- **NFA7.1:** Transaktionale Datenbankoperationen
- **NFA7.2:** Lebensdauer-Management für temporäre Objekte
- **NFA7.3:** Datenbank-Normalisierung (3. Normalform)
- **NFA7.4:** Foreign Keys für referenzielle Integrität
- **NFA7.5:** Automatisierte Datenbank-Migrationen

#### NFA8: Testing
- **NFA8.1:** Mindestens 70% Code-Coverage
- **NFA8.2:** Automatisierte Tests in CI/CD
- **NFA8.3:** Integration Tests für API-Endpoints
- **NFA8.4:** End-to-End Tests für kritische User-Flows
- **NFA8.5:** Performance Tests regelmäßig durchführen
- **NFA8.6:** Live-Testumgebung mit echten Daten (anonymisiert)

---

## 3. Systemarchitektur

### 3.1 Technologie-Stack

```
┌─────────────────────────────────────────────────────────────┐
│                    CLIENT LAYER                             │
│  React/JavaScript (Frontend) | PHP (Web View) | Desktop UI  │
└────────────────────────────┬────────────────────────────────┘
                             │
┌────────────────────────────┴────────────────────────────────┐
│                    API LAYER                                │
│  RESTful API (Python - Flask/FastAPI)                       │
│  Endpoints für alle Operationen                             │
└────────────────────────────┬────────────────────────────────┘
                             │
┌────────────────────────────┴────────────────────────────────┐
│                    SERVICE LAYER                            │
│  Business Logic | Authentication | Validation              │
│  Libraries & Utilities | Persistence Layer                  │
└────────────────────────────┬────────────────────────────────┘
                             │
┌────────────────────────────┴────────────────────────────────┐
│                    DATA LAYER                               │
│  MySQL Database | Cached Data | File Storage               │
└─────────────────────────────────────────────────────────────┘
```

### 3.2 Architektur-Pattern

**MVC-Pattern:**
- **Model:** Datenstrukturen mit Java/PHP Klassen
- **View:** React/PHP-Templates (responsive, mobile-optimiert)
- **Controller:** Python API-Endpoints, Java Service-Controller

**Principles:**
- Single Responsibility Principle (SRP)
- Open/Closed Principle (OCP)
- Liskov Substitution Principle (LSP)
- Interface Segregation Principle (ISP)
- Dependency Inversion Principle (DIP)

### 3.3 Verzeichnisstruktur

```
├── src/                           # Java Source Code
│   ├── volleyball/                # Domänen-Klassen
│   └── (weitere Domänen)
│
├── services/                      # Microservices
│   ├── python-api/                # Python API Service
│   │   ├── app.py                 # Flask/FastAPI Hauptdatei
│   │   ├── models/                # Datenmodelle
│   │   ├── routes/                # API Endpoints
│   │   ├── services/              # Business Logic
│   │   ├── utils/                 # Utilities & Helpers
│   │   └── requirements.txt       # Python Dependencies
│   └── Dockerfile                 # Container Image
│
├── webapp/                        # Web Frontend
│   ├── public/                    # Web-zugängliche Assets
│   │   ├── index.php              # PHP Entry Point
│   │   ├── app.js                 # React/JS Frontend
│   │   └── style.css              # Styling
│   ├── src/                       # Frontend Source
│   └── Dockerfile                 # Container Image
│
├── docs/                          # Dokumentation
│   └── handbuch/                  # Handbuch & Guides
│       ├── PFLICHTENHEFT.md       # Anforderungen (dieses Dokument)
│       ├── ARCHITEKTUR.md         # Technische Architektur
│       ├── INDEX.md               # Dokumentations-Index
│       ├── README.md              # Übersicht
│       └── (weitere Dokumentationen)
│
├── docker/                        # Docker Configurations
│   └── mysql/
│       └── init/
│           └── 01-init.sql       # Datenbank-Init
│
├── scripts/                       # Automation Scripts
│   ├── bootstrap.sh               # Setup
│   ├── start-services.sh          # Start Services
│   ├── stop-services.sh           # Stop Services
│   ├── validate-security.sh       # Security Checks
│   ├── validate-architecture.sh   # Architecture Checks
│   ├── validate-docs.sh           # Documentation Checks
│   ├── test-services.sh           # Run Tests
│   └── test-java.sh               # Java Tests
│
├── docker-compose.yml             # Compose Definition
├── LICENSE                        # Lizenz
└── README.md                      # Projekt-Übersicht
```

### 3.4 Datenbankschema

```sql
-- Beispiel-Tabellen für OOP-Modellierung
CREATE TABLE Spieler (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  rolle ENUM('Kaderspieler', 'Ersatzspieler')
);

-- Weitere Domain-spezifische Tabellen folgen
-- (Normalisierung: 3NF)
```

---

## 4. Erfolgskriterien

### 4.1 Architektur & Code-Qualität
- [x] OOP-Prinzipien vollständig implementiert
- [x] MVC-Pattern auf allen Ebenen
- [x] Keine Codewiederholungen (DRY)
- [x] Modularer Aufbau mit klarer Separation of Concerns
- [x] Alle Komponenten testbar

### 4.2 Sicherheit
- [ ] Security-Audit bestanden
- [ ] Alle OWASP Top 10 adressiert
- [ ] Encryption für sensible Daten
- [ ] Regelmäßige Penetration Tests geplant
- [ ] Backup-Strategie implementiert und getestet

### 4.3 Dokumentation
- [ ] README in jedem Verzeichnis
- [ ] Vollständiges Handbuch mit Installationsanleitung
- [ ] API-Dokumentation (Swagger/OpenAPI)
- [ ] Architektur-Diagramme und Erklärungen
- [ ] Changelog für alle Versionen
- [ ] Code-Kommentare für komplexe Logik

### 4.4 Testing & Quality Assurance
- [ ] Unit Tests mit ≥70% Coverage
- [ ] Integration Tests für alle API-Endpoints
- [ ] End-to-End Tests für kritische Flows
- [ ] Performance Tests dokumentiert
- [ ] Live-Testumgebung permanent verfügbar

### 4.5 Automation & DevOps
- [ ] CI/CD Pipeline implementiert
- [ ] Automatisierte Tests vor Deployment
- [ ] Automatisierte Security Checks
- [ ] Automatisierte Dokumentations-Validierung
- [ ] Container-Ready (Docker)
- [ ] Orchestration möglich (Docker Compose)

---

## 5. Umfang & Abgrenzung

### 5.1 In Scope
- **Frontend:** Responsive Web-UI mit React/JavaScript
- **Backend:** Python API mit Business-Logic
- **Datenbank:** MySQL mit vollständigem Schema
- **Desktop:** Java-basierte GUI-Komponenten
- **Container:** Docker & Docker Compose
- **Security:** Vollständige Absicherung nach Best Practices
- **Testing:** Unit, Integration, End-to-End Tests
- **Dokumentation:** Handbuch, API-Docs, Architektur
- **Automation:** CI/CD, Security Checks, Validation Scripts
- **Persistenz:** Datenbankoperationen & Backups

### 5.2 Out of Scope (für V1)
- Mobile native Apps (iOS/Android)
- Machine Learning / AI Komponenten
- Real-time Collaboration Features
- Advanced Analytics Dashboard
- Multi-Tenant Support
- Compliance für spezifische Industrien (HIPAA, PCI-DSS, etc.)

### 5.3 Zukünftige Erweiterungen
- Mobile Native Apps
- Microservices mit Kubernetes
- Advanced Monitoring & Analytics
- Plugin System
- Machine Learning Integration

---

## 6. Technologie & Stackanforderungen

### 6.1 Backend
- **Sprachen:** Python 3.9+, Java 11+
- **Frameworks:** Flask/FastAPI (Python), Spring Boot (Java)
- **Datenbank:** MySQL 8.0+
- **Persistenz:** ORM (SQLAlchemy für Python, Hibernate für Java)

### 6.2 Frontend
- **Sprachen:** JavaScript ES6+, PHP 7.4+
- **Frameworks:** React 17+
- **Styling:** CSS3, responsive design
- **Package Manager:** npm/yarn

### 6.3 Deployment & Operations
- **Container:** Docker 20.10+
- **Orchestration:** Docker Compose 2.0+
- **Version Control:** Git 2.30+
- **CI/CD:** GitHub Actions (oder ähnlich)

### 6.4 Development Tools
- **IDE:** VS Code mit Extensions
- **Testing:** Jest (JS), pytest (Python), JUnit (Java)
- **Linting:** ESLint, Pylint, Checkstyle
- **Documentation:** Markdown, PlantUML für Diagramme

---

## 7. Quality Gates & Validierung

### 7.1 Automatisierte Prüfungen
```bash
# Security Validation
bash scripts/validate-security.sh

# Architecture Validation  
bash scripts/validate-architecture.sh

# Documentation Validation
bash scripts/validate-docs.sh
```

### 7.2 Prüfkriterien
- ✅ Keine Secrets im Code
- ✅ Keine Copy-Paste Codeblöcke
- ✅ Alle Dateien dokumentiert
- ✅ Konsistente Namenskonventionen
- ✅ Unit Tests bestanden
- ✅ Code Coverage ≥70%

### 7.3 Deployment-Bedingungen
- Alle Quality Gates bestanden
- Code Review durchgeführt
- Tests erfolgreich
- Sicherheitsprüfung grün
- Dokumentation aktuell

---

## 8. Best Practices & Prinzipien

### 8.1 Entwicklung
- **Code Quality:** Clean Code, SOLID Principles
- **Testing:** TDD (Test Driven Development)
- **Documentation:** Self-documenting Code + Kommentare
- **Version Control:** Aussagekräftige Commit Messages
- **Code Review:** Peer Review vor Merge

### 8.2 Architektur
- **Redundanzfreiheit:** DRY Principle durchgängig
- **Modularität:** Loose Coupling, High Cohesion
- **API Design:** RESTful, Versioniert, Dokumentiert
- **Database:** Normalisiert, mit Constraints
- **Security:** Defense in Depth, Principle of Least Privilege

### 8.3 Operations
- **Monitoring:** Real-time Health Checks
- **Logging:** Strukturierte Logs (keine Secrets)
- **Backup:** Täglich, mit Recovery Tests
- **Updates:** Regelmäßige Patches & Security Updates
- **Documentation:** Runbooks für Incidents

---

## 9. Live-Testumgebung

### 9.1 Verfügbarkeit
- Die Testumgebung ist **permanent** verfügbar für alle Nutzer des Repositories
- Automatische Deployments bei Änderungen auf `main` Branch
- Staging-Umgebung für neue Features

### 9.2 Setup
```bash
# Start all services in Docker
bash scripts/start-services.sh

# Services are available at:
# - Web Frontend: http://localhost:8000
# - Python API: http://localhost:5000
# - MySQL: localhost:3306
```

### 9.3 Test-Szenarien
- Alle CRUD-Operationen
- User-Flows end-to-end
- API-Endpoints
- Datenbankintegrität
- Sicherheitsfeatures

### 9.4 Feedback & Monitoring
- Logs in `logs/` Verzeichnis
- Health-Checks automatisch durchgeführt
- Performance Metriken exportiert
- Fehler werden geloggt und analysiert

---

## 10. Risiken & Mitigationsmaßnahmen

| Risiko | Wahrscheinlichkeit | Impact | Mitigation |
|--------|-------------------|--------|-----------|
| Redundanzen entstehen trotz System | Hoch | Mittel | Regelmäßige Audits, Checklisten |
| Sicherheitslücken nicht erkannt | Mittel | Sehr Hoch | Security Reviews, Penetration Tests |
| Performance-Probleme | Mittel | Mittel | Load Tests, Profiling |
| Dokumentation wird veraltet | Hoch | Mittel | Review-Prozess, Automation |
| Deployment-Fehler | Niedrig | Hoch | CI/CD, Rollback-Strategie |

---

## 11. Versionierung & Release-Plan

### 11.1 Version 1.0 (Launch)
- ✅ Core Architektur
- ✅ Basic CRUD Operations
- ✅ Security Foundation
- ✅ Dokumentation

### 11.2 Version 1.1+ (Enhancement)
- User Management erweitern
- Performance optimieren
- Zusätzliche API-Endpoints
- Advanced Security Features

### 11.3 Version 2.0 (Major Update)
- Mobile native App
- Microservices-Migration
- Advanced Analytics
- Multi-tenant Support

---

## 12. Approval & Sign-Off

| Rolle | Name | Datum | Unterschrift |
|-------|------|-------|-------------|
| Projektleiter | __________ | __________ | __________ |
| Sicherheitsteam | __________ | __________ | __________ |
| Architektur | __________ | __________ | __________ |
| QA Lead | __________ | __________ | __________ |

---

**Dokumentversion:** 2.0 | **Status:** Aktiv | **Letzter Update:** 14. April 2026

---

**Kontakt & Support:**  
Für Fragen zur Wissensdatenbank: Siehe MARSCHPLAN.md und prozesse/neue-routine-erstellen.md

**Version History:**
- v1.0 (23.03.2026): Initiales Pflichtenheft erstellt
