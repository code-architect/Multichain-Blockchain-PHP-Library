# Multichain Blockchain PHP library

This is a library which I have created for my recent project.
Its a useful tool if you want implement Multichain blockchain in  your projects. It is very easy to
use and work with. 
I would suggest you to wrap around an MVC framework around it so cn be used kind of a BaaS (Blockchain as a Service)
MultiChain 2.3.3. update the library `core/Private/MultiChainClient.php` to be able to use updated library.

It is fairly easy Just go through `index.php` most of the examples provided there and the code is documented(can't believe it)

## Basic commands fot Multichain Blockchain 
To be able to work with multichain so basic cli commands are required, which are given below


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

