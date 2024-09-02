# ⚙️ ETL-FFLCH

[![eng](https://img.shields.io/badge/lang-en-blue.svg)](https://github.com/fflch/etl/blob/main/README.eng.md)
[![pt-br](https://img.shields.io/badge/lang-pt--br-red.svg)](https://github.com/fflch/etl/blob/main/README.md)


## 🗒️ Description

ETL-FFLCH is a tool designed to streamline Replicado USP data by transforming and reorganizing it into a more accessible and practical data source. It (efficiently, hopefully) extracts, transforms, and loads data that is useful to FFLCH into a highly denormalized and simplified database. Originally designed to improve data usability and reduce errors associated with the intricateness of Replicado USP, ETL-FFLCH now has its streamlined data publicly available through [FFLCH API](https://api.fflch.usp.br), making our faculty's data easily accessible and integrable for anyone.


#### 🌟 Core Benefits

- **Reformatting**: ETL-FFLCH allows for customizable manipulation of Replicado USP data, making it easier to format, adapt and enhance data to address gaps and improve consistency, ensuring it better meets the needs of our faculty.

- **Streamline**: Remodels USP Replicado data, which is complex and scattered, in order to offer a more accessible data source.

#### 🚧 Limitations

 - **Redundancy**: The resulting database is highly denormalized, leading to a large amount of redundant data. Although this makes it easier to use, it is not recommended for many purposes.

 - **Reliability**: Due to the inherent issues with Replicado USP data and the difficulties in fully diagnosing and addressing these problems, it's crucial to use ETL-FFLCH data with care and remain critical of its accuracy, especially when dealing with older data. If you think you found any mistakes, don't hesitate to contact STI-FFLCH or [EAIP-FFLCH](eaipfflch@usp.br).
 
 - **Full reload**: Since the Replicado USP database lacks `updated_at` timestamps, incremental data changes cannot be easily identified. As a result, the most practical approach to account for any updates is to refresh the entire dataset. This means that almost every piece of data is dropped and fully reloaded each time the ETL process runs. (Table *lattes* is the solo exception.)

 For detailed setup instructions, please refer to [Deployment Instructions](#-deployment-instructions).

<br>

## 🗃️ Data Organization Overview

 For organizational purposes, we have categorized the data into nine distinct groups. These categories often serve as the basis for how data is divided in folders within our code. The categories are:

- `People`: Information about each individual associated with FFLCH.
- `Undergraduate Studies`: Data related to undergraduate courses and their students, including undergraduate research.
- `Graduate Studies`: Information concerning graduate programs and their students.
- `Advanced Researches`: Data on advanced research activities, that is, made by postdoctoral researchers and associate researchers.
- `Staff`: Details about administrative and support staff.
- `Culture and Extension`: Information related to cultural activities and extension programs.
- `USP Programs`: Information on the various financial aid, programs, and scholarships available at USP.
- `Lattes`: Information from the Lattes Curriculum, a Brazilian academic curriculum platform.
- `Socioeconomic Questionnaire`: Data from undergraduates socioeconomic questionnaires.

<br>

## 🔧 Deployment Instructions

**1.** First, have all the project's dependencies installed:

```sh
composer install
```

**2.** Make a copy of *.env.example* and configure your *.env* with the access credentials and settings for both Replicado USP and a local MySQL/MariaDB database:

```sh
cp .env.example .env
```

**3.** After your local database is set up, you may create (or recreate) the tables with

```sh
php builder.php
```

(To bypass the confirmation prompt and force rebuild, you can simply pass the `-y` parameter.)

**4.** Once you have created them, data can be inserted (or updated) whenever needed by:

```sh
php main.php
```

(To force build/rebuild while running main.php, you can pass the `-f` parameter.)

**5.** To check the last time the ETL jobs were executed, use the `check.php` script:

```sh
php check.php
```

**6.** Finally, if you'd like to drop all tables, you may run:

```sh
php drop.php
```

<br>

## 🧩 Basic Code Structure

- `config/`: Manages local database connection and initializes .env settings.
- `src/`: Contains the project's source code.
    
    - `Extraction/`: Includes components for the Extraction part of (E)TL.
        - `ReplicadoDB.php`: Manages the connection to the Replicado USP database.
        - `TempTables/Scripts/`: Stores scripts for creating temporary tables used for a first processing of the data, which will be retrieved later.
        - `TempManager.php`: Manages the creation of those necessary temporary tables.
        - `Queries/`: Contains queries for fetching the data from Replicado USP, including those in our temp tables.
    
    - `Transformation/`: Contains components for the Transformation phase of E(T)L.
        - `ReplicadoModels/`: Houses the data models from our Replicado USP queries, including their remapping and remodeling for subsequent loading.
        - `Transformer.php`: Handles data retrieval and transformation by executing SQL queries, applying pagination and replacements, and mapping results.

    - `Loading/`: Contains components for the Loading phase of ET(L).
        - `DbHandle/`: Manages general database processes such as cleaning tables, updating them, and invoking the table handler.
        - `SchemaBuilder/Tables/`: Defines the structure of each table to be created in the new database.
        - `SchemaBuilder/TableHandler.php`: Interprets these structures and creates each table.
        - `Models/`: Stores models for the new database tables.
        - `Operations/`: Contains instructions for loading each table.

    - `Jobs/`: Houses individual update jobs for each category in this project. (See [Data Organization Overview](#️-data-organization-overview))