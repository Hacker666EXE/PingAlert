# 🖥🕵‍♂️ PingAlert Ferramenta de Monitoramento de Status de Sites

Eu desenvolvi uma ferramenta automatizada para monitorar o status de vários sites de forma contínua e eficiente. Com ela, você pode inserir uma lista de URLs diretamente no código, e o sistema ficará monitorando o estado de cada uma dessas URLs. A ferramenta verifica o **código de status HTTP** de cada site (como `200` para sucesso, `404` para página não encontrada, ou `500` para erro no servidor) e mede a **latência**, ou seja, o tempo de resposta em milissegundos.

## Funcionalidades Principais:
- **Monitoramento contínuo**: A página se atualiza automaticamente a cada 30 segundos, e é exibido um cronômetro na tela indicando quanto tempo falta para a próxima atualização.
- **Exibição visual clara**: Quando um site está online (status `200`), a linha correspondente aparece destacada em verde. Se houver algum erro ou se o site estiver offline, o status aparece em vermelho, facilitando a identificação de problemas.
- **Relatório detalhado**: Para cada URL monitorada, são exibidos o código HTTP, a latência em milissegundos e eventuais erros que ocorreram durante a verificação.
- **Alerta sonoro**: Caso algum serviço fique offline, a ferramenta toca um som de alerta para notificar o administrador.

## Como funciona:
- **Verificação de status**: O código faz uma requisição HTTP para cada URL da lista e coleta informações como o tempo de resposta e o código de status.
- **Atualização automática**: A página se recarrega a cada 30 segundos, e um cronômetro em destaque indica o tempo até a próxima atualização.
- **Notificações em tempo real**: Caso algum site fique offline, além da exibição visual, um som de alerta é reproduzido para chamar a atenção imediata do administrador.

## Futuras Implementações:
Futuramente, vou adicionar uma opção para enviar um **e-mail de notificação** sempre que algum servidor monitorado ficar offline. Isso permitirá uma resposta ainda mais rápida a eventuais problemas.
![PingAlert](PingAlert.png)