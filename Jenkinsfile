pipeline {
    agent { label 'dev' }

    tools {
        // Use the Git tool configured in Jenkins
        git 'git'
    }

    stages {
        // stage('Cleaning Up Files') {
        //     steps {
        //         script {
        //             sh 'sudo rm -rf /home/ubuntu/actions-runner/_work/school-management/school-management/dev'
        //         }
        //     }
        // }
        
        stage('Clone Repositories') {
            steps {
                script {
                    git branch: 'main', url: 'https://github.com/sankar0812/school-eduzon360.git'
                }
            }
        }
        
        stage('Composer Update') {
            steps {
                script {
                    dir('dev') {
                        sh '''
                            cp .env.dev .env
                            composer update
                            sudo chmod -R 777 storage
                            sudo chmod -R 777 bootstrap/cache
                            sudo chmod -R 777 /home/ubuntu/actions-runner
                            php artisan key:generate
                        '''
                    }
                }
            }
        }
        
        stage('Restart PHP Service') {
            steps {
                script {
                    sh 'sudo service school-dev restart'
                }
            }
        }
        
        stage('Restart Nginx Service') {
            steps {
                script {
                    sh 'sudo service nginx restart'
                }
            }
        }
    }
}
