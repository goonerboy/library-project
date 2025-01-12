pipeline {
    agent any  

    environment {
        
        DB_HOST = 'postgres'  
        DB_USER = 'postgres'
        DB_PASSWORD = '123'
        DB_NAME = 'library_system'
    }

    stages {
        stage('Build') {
            steps {
                echo 'Building the application...'
              
                sh './gradlew clean build'
            }
        }

        stage('Test') {
            steps {
                echo 'Running tests...'
               
                sh './gradlew test'
            }
        }

        stage('Docker Build') {
            steps {
                echo 'Building Docker image...'
               
                sh 'docker-compose build'
            }
        }

        stage('Deploy') {
            steps {
                echo 'Deploying the application...'
          
                sh 'docker-compose up -d'
            }
        }
    }

    post {
      
        always {
            echo 'Cleaning up...'
         
        }
    }
}
