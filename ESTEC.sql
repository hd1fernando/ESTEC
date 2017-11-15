create database ESTEC;

use ESTEC;

create table if not exists Endereco(
id_endereco int not null auto_increment,
logradouro varchar(50),
numero int,
complemento varchar(50),
bairro varchar(50),
cidade varchar(50),
estado char(2) default 'MG',
primary key(id_endereco)
);

create table if not exists Cliente(
id_cliente int not null auto_increment,
nome_cliente varchar(150),
telefone varchar(20),
email varchar(100),
fk_endereco int,
primary key(id_cliente),
foreign key(fk_endereco) references Endereco(id_endereco)
);

create table if not exists Servico(
id_servico int not null auto_increment,
nome_servico varchar(50),
primary key(id_servico)
);

create table if not exists Agendamento(
id_agendamento int not null auto_increment,
data_agendamento date,
hora time,
primary key(id_agendamento)
);

create table if not exists Professor(
id_professor int not null auto_increment,
nome varchar(150),
telefone varchar(20),
email varchar(100),
primary key(id_professor)
);


create table if not exists Usuario(
id_usuario int not null auto_increment,
usuario varchar(20),
senha varchar(100),
fk_professor int,
primary key(id_usuario),
foreign key(fk_professor) references Professor(id_professor)
);

create table if not exists Turma(
id_turma int not null auto_increment,
nome_turma varchar(50),
primary key(id_turma)
);

create table if not exists Professor_Turma(
id_professor_turma int not null auto_increment,
fk_professor int,
fk_turma int,
primary key(id_professor_turma),
foreign key(fk_professor) references Professor(id_professor),
foreign key(fk_turma) references Turma(id_turma)
);

create table if not exists Aluno(
id_aluno int not null auto_increment,
nome varchar(150),
telefone varchar(20),
email varchar(100),
fk_cliente int,
fk_turma int,
primary key(id_aluno),
foreign key(fk_cliente) references Cliente(id_cliente),
foreign key(fk_turma) references Turma(id_turma)
);


create table if not exists Atendimento(
id_atendimento int not null auto_increment,
status_atendimento enum('ok','dependente'),
feedback int,
observacao text,
fk_agendamento int,
fk_servico int,
fk_cliente int,
fk_aluno int,
foreign key(fk_agendamento) references Agendamento(id_agendamento),
foreign key(fk_servico) references Servico(id_servico),
foreign key(fk_aluno) references Aluno(id_aluno),
foreign key(fk_cliente) references Cliente(id_cliente),
primary key(id_atendimento)
);
































