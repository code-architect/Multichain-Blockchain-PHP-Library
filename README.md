# Multichain Blockchain PHP library

This is a library that I have created for my recent project.
It's a useful tool if you want to implement Multichain blockchain in  your projects. It is very easy to use and work with. 
I would suggest you wrap around an MVC framework around it so it can be used kind of a BaaS (Blockchain as a Service), you can send request and process it via queue manager like Kafka or rabbitmq.
MultiChain 2.3.3. update the library `core/Private/MultiChainClient.php` to be able to use the updated library and change the `.env` file details. That should get your project up. I would highly recommend using docker as a deploy container.

It is fairly easy Just go through `index.php` most of the examples are provided there and the code is documented(can't believe it)

FYI
Several process manager tools can be used to manage RabbitMQ processes. Here are a few commonly used ones:

Systemd:Systemd is a Linux initialization system and service manager. It's commonly used on modern Linux distributions to manage system processes, including RabbitMQ.

Supervisord:Supervisord is a process control system that allows its users to monitor and control a number of processes on Unix-like operating systems. It's often used to manage RabbitMQ processes.

Docker Compose:If you are using Docker to containerize your RabbitMQ application, Docker Compose can be used to manage multiple containers, including RabbitMQ.

## Basic commands for Multichain Blockchain 
To be able to work with multichain some basic CLI commands are required, which are given below


Starting a node <br/>
`multichaind <chainName> -daemon`<br/><br/>

Get all the required parameters <br/>
`multichain-cli  <chainName> getinfo`<br/><br/>

Get get the information of the block and who mined it <br/>
`multichain-cli  <chainName> getblock <block height>`<br/><br/>

Create a new multichain blockchain <br/>
`multichain-util create <chainName>`<br/><br/>


Connect to blockchain from second node <br/> 
`multichaind <chainname>@[ip-address]:[port]`<br/><br/>

Provide required permissions to second node <br/>
`Multichain-cli <chainnamer> grant <walletaddress> connect`<br/><br/>

Reconnect from Second Node <br/>
`multichaind <chainname>@[ip-address]:[port]`<br/><br/>

Multichain get info <br/> 
`multichain-cli <chainName> getinfo`<br/><br/>

List of addresses <br/> 
`multichain-cli  <chainName> listaddresses`<br/><br/>

Get new address <br/> 
`multichain-cli  <chainName> getnewaddress`<br/><br/>

List permissions <br/>
`multichain-cli <chainName> listpermissions`<br/><br/>

List permissions type <br/>
`multichain-cli <chainName> listpermissions issus/mine/admin`<br/><br/>

